<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
               
            <div class="row p-1 py-3 d-flex align-items-center justify-content-between">
                <div class="col-xl-12 col-lg-12 col-sm-6 text-center mb-3">
                    <h3 class="text-success" style="visibility: visible">
                         Megabyte Bot is activated and autotrading is on.
                    </h3>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Rest of your content here -->

                <div class="col-xl-7">
                  <div class="card d-none d-xl-block  mb-xl-0">
                    <h5 class="mb-2 text-success">OPX AI Trading Bots</h5>
                    <p>{{siteName()}} Trading platforms employ sophisticated algorithms
                      connected to market data to make trading decisions. </p>
                    <a href="{{ route('home') }}" type="button" class="btn btn-rounded btn-primary">Deposit Funds</a>
                  </div>              
                  </div>

                <div class="col-xl-5">
                  <div style="height: 186px;" class="card mb-xl-0">
                    <div class="text-center">
                      <span class="text-success">Strategy Wallet</span>
                      <h2 class="mx-2 mb-1" style="visibility: visible">
                        {{ currency() }} {{calStrategyBalance(auth::user()->id)}}
                    </h2>
                      <p>To activate AI bots to trade in world market, You must add funds in your strategy wallet accordingly.</p>
                    </div>
                  </div>               
                 </div>

            </div>
        
            
                 

            <!-- Add carousel container -->
            <div id="aiBotsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <!-- First AI bot section -->
                    <div class="carousel-item active">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="card mb-xl-0 my-4">
                                    <div class="row d-flex align-items-center justify-content-between">
                                        <div class="col-xl-6 col-12 pt-3 text-center">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-xl-6"><img style="max-width: 300px;" src="{{ asset('')}}user/images/aibot10.gif " class="img-fluid"></div>
                                                <div class="col-xl-6">
                                                    <h3 class="text-dark"> Kilobyte</h3>
                                                    <h5 class="counter text-danger mx-2" style="visibility: visible">
                                                        50$ TO $499
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-12 pt-3 text-center">
                                            <span class="text-dark">Generates Daily</span>
                                            <h4 class="counter text-success mx-2 mb-1" style="visibility: visible">
                                                1 To 3% Returns
                                            </h4>
                                            <p> Kilobyte offers a lot of great
                                                features, such as AI Trend
                                                Forecasting.
                                                The platform’s AI trend prediction
                                                engine relies on historical price
                                                data to predict shifting market trends.
                                                It includes a confidence level so you
                                                can see the odds of success
                                                for each predicted trend.                <br>
                                                <span class="text-dark">Bot Activation Fees: <span class="text-danger">5%</span>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>                        </div>
                    </div>

                    <!-- Second AI bot section -->
                    <div class="carousel-item">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="card mb-xl-0 my-4">
                                    <div class="row d-flex align-items-center justify-content-between">
                                        <div class="col-xl-6 col-12 pt-3 text-center">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-xl-6"><img style="max-width: 300px;" src="{{ asset('')}}user/images/aibot22.gif" class="img-fluid"></div>
                                                <div class="col-xl-6">
                                                  <h3 class="text-dark"> Megabyte</h3>
                                                  <h5 class="counter text-danger mx-2" style="visibility: visible">
                                                    $500 TO $1999                  </h5>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-xl-6 col-12 pt-3 text-center">
                                              <span class="text-dark">Generates Daily</span>
                                              <h4 class="counter text-success mx-2 mb-1" style="visibility: visible">
                                
                                                1.5 To 4% Returns              </h4>
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
                            </div>                        </div>
                    </div>

                    <!-- Third AI bot section -->
                    <div class="carousel-item">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="card mb-xl-0 my-4">
                                    <div class="row d-flex align-items-center justify-content-between">
                                        <div class="col-xl-6 col-12 pt-3 text-center">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-xl-6"><img style="max-width: 300px;" src="{{ asset('')}}user/images/aibot33.gif " class="img-fluid"></div>
                                                <div class="col-xl-6">
                                                    <h3 class="text-dark"> Gigabyte</h3>
                                                    <h5 class="counter text-danger mx-2" style="visibility: visible">
                                                        $2000 TO $4999
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-12 pt-3 text-center">
                                            <span class="text-dark">Generates Daily</span>
                                            <h4 class="counter text-success mx-2 mb-1" style="visibility: visible">
                                                2 To 5% Returns
                                            </h4>
                                            <p> Gigabyte proprietary algorithm scans through historical market data to find trends in the world markets. After identifying these trends, it sends them to AI algorithm who use the information to make effective and profitable trades. Also Identify Trend’s BREAKOUT or BREAKDOWN and takes perfect entry automatically.              <br>
                                                <span class="text-dark">Bot Activation Fees: <span class="text-danger">7%</span>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>                        </div>
                    </div>

                    <!-- Fourth AI bot section -->
                    <div class="carousel-item">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="card mb-xl-0 my-4">
                                    <div class="row d-flex align-items-center justify-content-between">
                                        <div class="col-xl-6 col-12 pt-3 text-center">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-xl-6"><img style="max-width: 300px;" src="{{ asset('')}}user/images/aibot44.gif " class="img-fluid"></div>
                                                <div class="col-xl-6">
                                                    <h3 class="text-dark"> Terabyte</h3>
                                                    <h5 class="counter text-danger mx-2" style="visibility: visible">
                                                        $5000 to 10000$
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-12 pt-3 text-center">
                                            <span class="text-dark">Generates Daily</span>
                                            <h4 class="counter text-success mx-2 mb-1" style="visibility: visible">
                                                3 To 6% Returns
                                            </h4>
                                            <p> Terabyte also performs random analyses of news articles from all across the globe. It analyzes social media events to keep you updated with the latest financial news. The software also has the ability to learn your preferences over time, meaning you will save time by not having to teach the program how you like to operate.       <br>
                                                <span class="text-dark">Bot Activation Fees: <span class="text-danger">8%</span>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>                        </div>
                    </div>

                </div>
                <!-- Carousel controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#aiBotsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#aiBotsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
