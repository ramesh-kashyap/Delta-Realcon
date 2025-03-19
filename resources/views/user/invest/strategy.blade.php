<div class="content-body">
    <div class="container-fluid">

        <div style="border:  1px solid #6a6d78;" id="terminal" class="col-xl-12 col-12 m-2 p-2">
            <div style="height: 530px;" class="row">
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container" style="height:100%;width:100%">
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                        {
                            "autosize": true,
                            "symbol": "BITSTAMP:BTCUSD",
                            "interval": "1",
                            "timezone": "Etc/UTC",
                            "theme": "dark",
                            "style": "1",
                            "locale": "en",
                            "enable_publishing": false,
                            "withdateranges": true,
                            "hide_side_toolbar": false,
                            "allow_symbol_change": true,
                            "calendar": false,
                            "studies": [
                                "STD;Bollinger_Bands",
                                "STD;EMA"
                            ],
                            "support_host": "https://www.tradingview.com"
                        }
                    </script>
                </div>
                <!-- TradingView Widget END -->
            </div>

        </div>


        <?php
        $status = false;
        $trade = false;
        if (isset($_GET['trade'])) {
          $trade = true;
          $trade_row =  \DB::table('contract')->where('c_status',1)->orderBy('c_time','DESC')->first();
          if (!$trade_row) {
            $status = true;
          }
          if ($status == true) {
            header("Location: strategy?notrade");
            exit();
          };
        }

            $u_id = Auth::user()->id;
            $userDetail = \DB::table('users')->where('id',$u_id)->first();
            $credits = $userDetail->u_credits;
            $opti = $userDetail->u_opt;
            $ref_id = $userDetail->u_ref;
            $u_str = $userDetail->u_strategy;
    
            $idx = -1;
            if ($u_str >= 50 && $u_str <= 999) {
            $idx = 1;
            } elseif ($u_str >= 1000 && $u_str <= 4999) {
            $idx = 2;
            } elseif ($u_str >= 5000 && $u_str <= 9999) {
            $idx = 3;
            } elseif ($u_str > 9999) {
            $idx = 4;
            }
          
                    
        ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <!-- Button column -->
                            <div class="col mb-1">
                                <button type="button" class="btn btn-primary">Trade History</button>
                                <a href="{{route('user.strategy')}}?trade"  class="btn btn-primary">Position</a>
                            </div>

                            <!-- Search bar column -->
                            <div class="col-auto">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <?php if (!$trade) {
                            ?>

                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Symbol</th>
                                        <th>Type</th>
                                        <th>Side </th>
                                        <th>Entry-Price </th>
                                        <th>Exit-Price </th>
                                        <th>Quantity</th>
                                        <th>Profit</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $u_id = Auth::user()->id;
                                    $sql =  \DB::table('contract')->where('user_id',$u_id)->where('c_status','-1')->orderBy('c_time','DESC')->limit(5)->get();
                                    $nums = $sql->count();
                                    if ($nums >= 1) {
                                    ?>
                                <?php
                                    }
                                        foreach ($sql as $key => $value) {
                                        $updated_time = date("d M h:iA", strtotime($value->c_time));
                                        $sym = strtoupper($value->c_name);
                                ?>

                                    <tr>
                                        <td><?php echo $value->c_time; ?></td>
                                        <td><?php echo $sym . "-USDT"; ?></td>
                                         <td> LMT</td>
                                         <td class="<?php if ($value->trade == "Buy") {
                                            echo "text-success";
                                          } else {
                                            echo "text-danger";
                                          };  ?>"><?php
                                                  echo $value->trade; ?></td>
                                         <td><?php echo ($value->c_buy); ?></td>
                                         <td><?php echo ($value->c_sell); ?></td>
                                         <td class="text-center">
                                            <?php echo $value->qty. ""; ?>
                                          </td>
                                           <td class="text-{{$value->decision==1?'success':'danger'}}"> <?php echo $value->decision==1?'+':'-';?><?php echo ($value->profit) . "USD"; ?></td>
                                      
                                    </tr>
                                    <?php };
                                    if ($nums <= 0) {
                                      // echo "No Trades";
                                    };
                                ?>

                                </tbody>
                            </table>
                        </div>

                        <?php } else { ?>



                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th scope="col">Profit</th>
                                        <th scope="col">Symbol</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Side</th>
                                        <th scope="col">Entry-Price</th>
                                        <th scope="col">Quantity</th>
                                        <th class="text-center" scope="col">Time</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $u_id = Auth::user()->id;
                                    $sql =  \DB::table('contract')->where('user_id',$u_id)->where('c_status',1)->orderBy('c_time','DESC')->get();
                                    $nums = $sql->count();
                                    if ($nums >= 1) {
                                    ?>
                                <?php
                                    }
                                        foreach ($sql as $key => $value) {
                                        $updated_time = date("d M h:iA", strtotime($value->c_time));
                                        $sym = strtoupper($value->c_name);
                                ?>

                                    <tr>
                                        <td id="profit"><span class="counter text-success"><?php echo "+" . ($value->profit) . "USD"; ?></span></td>
                                        <td><?php echo $sym . "-USDT"; ?></td>
                                         <td> LMT</td>
                                         <td class="<?php if ($value->trade == "Buy") {
                                            echo "text-success";
                                          } else {
                                            echo "text-danger";
                                          };  ?>"><?php
                                                  echo $value->trade; ?></td>
                                        <td id="price_"><span><?php echo ($value->c_buy); ?></span></td>
                                       
                                         <td class="text-center">
                                            <?php echo $value->qty. ""; ?>
                                          </td>
                                          <td style="color:#b2b5be;"> <?php echo $value->c_time; ?></td>
                                      
                                    </tr>
                                    <?php };
                                    if ($nums <= 0) {
                                      // echo "No Trades";
                                    };
                                ?>

                                </tbody>
                            </table>
                        </div>

                        <script>
                            function pollServer() {
                              fetch("{{route('manage-trade')}}")
                                .then(response => response.json()) // Parse JSON response
                                .then(data => {
                                  if (!data.status) {
                                    document.getElementById('price_').innerHTML = `
                                    <span class="counter">${data.btc_price}</span>
                                    `;
                                    if (data.action == "incre") {
                                       document.getElementById('profit').innerHTML = `
                              <span class="counter text-success">+${(data.profit/100).toFixed(5)}USDT</span>
                              `;
                                    } else {
                                      document.getElementById('profit').innerHTML = `
                              <span class="counter" style="color:#c42c2c">${(data.profit/100).toFixed(5)}USDT</span>
                              `;
                                    }
                                  } else {
                                    // exit
                                    location.reload();
                                  }
                                  setTimeout(pollServer, 10);
                                })
                                .catch((error) => {
                                  console.error("Error polling server:", error);
                                  // Retry polling after a delay (e.g., every 5 seconds)
                                  setTimeout(pollServer, 5000);
                                });
                            }
                            pollServer();
                          </script>
                        <?php }; ?>

                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
