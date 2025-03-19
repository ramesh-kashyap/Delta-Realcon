<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="row p-1 py-3 d-flex align-items-center justify-content-between">
                <div class="col-xl-12 col-lg-12 col-sm-6 text-center mb-1">
                    <h3 class="text-success" style="visibility: visible">

                        @if($balance >= 50 && $balance <= 499)
                        Kilobyte
                        @elseif($balance >= 500 && $balance <= 1999)
                        Megabyte
                        @elseif($balance >= 2000 && $balance <= 4999)
                        Gigabyte
                        @elseif($balance >= 5000 && $balance <= 10000)
                        Terabyte
                        @endif



                          Bot is activated, and autotrading is on.
                    </h3>
                </div>
            </div>
        </div>

        <div class="row mb-3 mt-2 pt-2">
            <div class="col-xl-7 d-md-block">
                <div class="card d-none d-xl-block card-green mb-xl-0 p-1 m-2">
                    <h4 class="text-center mb-3">Bot Expiring In</h4>
                    <div class="row">

                        @if($balance > 0)
                        <div id="clockdiv">
                            <div>
                               
                                <!-- Show No. of days -->
                                <span class="days" id="day"></span>
                                <div class="smalltext">Days</div>
                            </div>
                            <div>
                               
                                <!-- Show no.of hours -->
                                <span class="hours" id="hour"></span>
                                <div class="smalltext">Hours</div>
                            </div>
                            <div>
                               
                                <!-- Show no. of minutes -->
                                <span class="minutes" id="minute"></span>
                                <div class="smalltext">Minutes</div>
                            </div>
                            <div>
                               
                                <!-- Show seconds -->
                                <span class="seconds" id="second"></span>
                                <div class="smalltext">Seconds</div>
                            </div>
                        </div>
                        <p id="demo"></p>

                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-5 d-md-block">
                <div style="height: 150px;" class="card mb-xl-0">
                    <div class="text-center">
                        <span class="text-success fs-18">Strategy Wallet</span>
                        <h4 class="mx-2 mb-1" style="visibility: visible">
                            {{ currency() }} {{calStrategyBalance(auth::user()->id)}}
                        </h4>
                        <p class="text-center">Early redemption fees 25% of the bot's trading capital amount.<br>
                            <a data-bs-toggle="modal" data-bs-target="#expModal" id="relbtn" type="button" class="btn btn-rounded btn-primary">
                                Deactivate</a>    
                                
                               
                        </p>
                        <div class="modal fade" id="expModal" tabindex="-1" role="dialog" aria-labelledby="DepositLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('user.deactivate') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="DepositLabel">Deactivate</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Your deposit form content goes here -->
                                           
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <p style="display:block">Early redemption fees 25% of the bots trading on capital amount.</p>
                                                        {{-- <p>Due to System Updation, Deactivation of any ID's is on hold. We will keep you updated on this as it Resume's.</p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="display:block">
                                                <div class="col-md-12 mb-4">
                                                    <div class="mb-3 text-success">
                                                        <?php 
                                                            
                                                            $u_str = Auth::user()->u_strategy;
                                                            ?>
                                                        <p>Your <?php echo $u_str - ($u_str * 0.25) . "$"; ?> Will Be Credited To Funding Wallet.                                                            .</p>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End of deposit form content -->
                                        </div>
                                        <div class="modal-footer" style="display:block">
                                            <button type="submit" class="btn btn-danger">Deactivate</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($balance >= 50 && $balance <= 499)
        <div class="col-lg-12">
             <div class="card mb-xl-0 my-4">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-xl-6 col-12 pt-3 text-center">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-6"><img style="max-width: 300px;" src="{{ asset('')}}user/images/aibot10.gif " class="img-fluid"></div>
                            <div class="col-xl-6">
                                <h3 class="text-dark"> Kilobyte</h3>
                                <h5 class="counter text-danger mx-2" style="visibility: visible">
                                    50$ TO 499$
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12 pt-3 text-center">
                        <span class="text-dark">Generates Daily</span>
                        <h4 class="counter text-success mx-2 mb-1" style="visibility: visible">
                            1% to 3% Returns
                        </h4>
                        <p> Kilobyte offers a lot of great features, such as AI Trend Forecasting. The platform’s AI trend prediction engine relies on historical price data to predict shifting market trends. It includes a confidence level so you can see the odds of success for each predicted trend. <br>
                            <span class="text-dark">Bot Activation Fees: <span class="text-danger">5%</span>
                            </span>
                        </p>
                    </div>
                </div>
             </div>
        </div>
        @elseif($balance >= 500 && $balance <= 1999)
        <div class="col-lg-12">
            <div class="card mb-xl-0 my-4">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-xl-6 col-12 pt-3 text-center">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-6"><img style="max-width: 300px;" src="{{ asset('')}}user/images/aibot22.gif" class="img-fluid"></div>
                            <div class="col-xl-6">
                              <h3 class="text-dark"> Megabyte</h3>
                              <h5 class="counter text-danger mx-2" style="visibility: visible">
                                500$ TO 1999$                  </h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-12 pt-3 text-center">
                          <span class="text-dark">Generates Daily</span>
                          <h4 class="counter text-success mx-2 mb-1" style="visibility: visible">
            
                            1.5% to 4% Returns              </h4>
                          <p> Megabyte which is an AI
            software that enables you to quickly
            build, back test, and automate trading
            strategies in Equities and
            Cryptocurrencies.
            The intuitive interface connects you to
            different data vendors and
            supports Bitcoin, Ethereum, XRP, and
            many other coins.
            Algoriz is developed so that Risk will
            be 2x or 3x smallerthan the
            reward.                 <br>
                            <span class="text-dark">Bot Activation Fees: <span class="text-danger">6%</span>
                            </span>
                          </p>
            
                        </div>
                </div>
            </div>
        </div>
        @elseif($balance >= 2000 && $balance <= 4999)
        <div class="col-lg-12">
            <div class="card mb-xl-0 my-4">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-xl-6 col-12 pt-3 text-center">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-6"><img style="max-width: 300px;" src="{{ asset('')}}user/images/aibot33.gif " class="img-fluid"></div>
                            <div class="col-xl-6">
                                <h3 class="text-dark"> Gigabyte</h3>
                                <h5 class="counter text-danger mx-2" style="visibility: visible">
                                    2000$ TO 4999$
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12 pt-3 text-center">
                        <span class="text-dark">Generates Daily</span>
                        <h4 class="counter text-success mx-2 mb-1" style="visibility: visible">
                            2% to 5% Returns
                        </h4>
                        <p> Gigabyte proprietary algorithm scans through historical market data to find trends in the world markets. After identifying these trends, it sends them to AI algorithm who use the information to make effective and profitable trades. Also Identify Trend’s BREAKOUT or BREAKDOWN and takes perfect entry automatically.              <br>
                            <span class="text-dark">Bot Activation Fees: <span class="text-danger">7%</span>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @elseif($balance >= 5000 && $balance <= 10000)
        <div class="col-lg-12">
            <div class="card mb-xl-0 my-4">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-xl-6 col-12 pt-3 text-center">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-6"><img style="max-width: 300px;" src="{{ asset('')}}user/images/aibot44.gif " class="img-fluid"></div>
                            <div class="col-xl-6">
                                <h3 class="text-dark"> Terabyte</h3>
                                <h5 class="counter text-danger mx-2" style="visibility: visible">
                                    5000$ to 10000$
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12 pt-3 text-center">
                        <span class="text-dark">Generates Daily</span>
                        <h4 class="counter text-success mx-2 mb-1" style="visibility: visible">
                            3% to 6% Returns
                        </h4>
                        <p> Terabyte also performs random analyses of news articles from all across the globe. It analyzes social media events to keep you updated with the latest financial news. The software also has the ability to learn your preferences over time, meaning you will save time by not having to teach the program how you like to operate.       <br>
                            <span class="text-dark">Bot Activation Fees: <span class="text-danger">8%</span>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        

    </div>
</div>
<script>
           
           let modifiedTime = "{{ $modifiedTime?$modifiedTime:0 }}"; // Assuming $modifiedTime is properly formatted

// Getting formated date from date string
let deadline = new Date(modifiedTime).getTime();

    // Calling defined function at certain interval
    let x = setInterval(function () {

        // Getting current date and time in required format
        var now =  new Date(new Date().toLocaleString('en-US', {timeZone: 'UTC'}))

        // Calculating difference
        let t = deadline - now;

        // Getting values of days,hours,minutes, seconds
        let days = Math.floor(
            t / (1000 * 60 * 60 * 24)
        );
        let hours = Math.floor(
            (t % (1000 * 60 * 60 * 24)) /
                (1000 * 60 * 60)
        );
        let minutes = Math.floor(
            (t % (1000 * 60 * 60)) / (1000 * 60)
        );
        let seconds = Math.floor(
            (t % (1000 * 60)) / 1000
        );

        // Show the output time
        document.getElementById("day")
                .innerHTML = days;
        document.getElementById("hour")
                .innerHTML = hours;
        document.getElementById("minute")
                .innerHTML = minutes;
        document.getElementById("second")
                .innerHTML = seconds;

        // Show overtime output
        if (t < 0) {
            clearInterval(x);
            document.getElementById(
                "demo"
            ).innerHTML = "TIME'S UP";
            document.getElementById(
                "day"
            ).innerHTML = "0";
            document.getElementById(
                "hour"
            ).innerHTML = "0";
            document.getElementById(
                "minute"
            ).innerHTML = "0";
            document.getElementById(
                "second"
            ).innerHTML = "0";
        }
    }, 1000);
</script>
<style>
            
           
            
            #clockdiv {
                font-family: sans-serif;
                color: #fff;
                display: inline-block;
                font-weight: 100;
                text-align: center;
                font-size: 30px;
            }
            #clockdiv > div {
                padding: 10px;
                border-radius: 3px;
                background: #00bf96;
                display: inline-block;
            }
            #clockdiv div > span {
                padding: 15px;
                border-radius: 3px;
                background: #00816a;
                display: inline-block;
            }
 
            /* Style for visible text */
            .smalltext {
                padding-top: 5px;
                font-size: 16px;
            }
        </style>
