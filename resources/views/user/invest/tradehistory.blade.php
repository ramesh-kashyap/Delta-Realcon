<div class="content-body">
    <div class="container-fluid">
     
  
  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Trade History</h4>
                        <div class="header-right">
                            <div class="input-group search-area ms-auto d-inline-flex">
                                <input type="text" class="form-control" placeholder="Search here">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text"><i class="flaticon-381-search-2"></i></button>
                                </div>
                            </div>
                  </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>TIME</th>
                                        <th>Exchange</th>
                                        <th>Symbol</th>
                                        <th>Side</th>
                                        <th>Entry Price</th>
                                        <th>Exit Price</th>
                                        <th>Quantity</th>
                                        <th>Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trades as $profit)
                                    <tr>
                                        <td>{{ $profit->c_time }}</td>
                                        <td>MegaBot AI </td>
                                        <td>{{ $profit->c_name }}</td>
                                        <td class="<?php if ($profit->trade == "Buy") {
                                            echo "text-success";
                                          } else {
                                            echo "text-danger";
                                          };  ?>"><?php
                                                  echo $profit->trade; ?></td>                                       
                                         <td>{{ $profit->c_buy }}</td>
                                        <td>{{ $profit->c_sell }}</td>
                                        <td>{{ $profit->qty }}</td>
                                        <td class="text-{{$profit->decision==1?'success':'danger'}}"> <?php echo $profit->decision==1?'+':'-';?><?php echo ($profit->profit) . "USD"; ?></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $trades->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
    </div></div></div>