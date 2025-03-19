<div class="container-fluid main-content settings px-2 px-lg-4">
    <!-- Tables -->
    <div class="row my-2 g-3 g-lg-4 pb-3 settings-inner">

   <style>
       .currencyBlock-gjg3vUXR {
    align-items: center;
    column-gap: 6px;
    display: inline-flex;
    vertical-align: middle;
    color: #fff !important;
}
.content-WOGqw5_Y {
    align-items: center;
    bottom: 0;
    display: flex;
    justify-content: center;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    color: #fff !important;
}
.tradingview-widget-copyright {
    display: none !important;
}
   </style>

        <div class="col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
            <div class="settings-tab">
                <h5 class="mb-0">News </h5>
    

                <div class="tab-content pt-2" id="pills-tabContent">
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
  {
  "feedMode": "all_symbols",
  "colorTheme": "dark",
  "isTransparent": true,
  "displayMode": "regular",
  "width": "100%",
  "height": 830,
  "locale": "en"
}
  </script>
</div>
<!-- TradingView Widget END -->
                </div>
            </div>
        </div>

      

    </div>



    @include('layouts.upnl.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deposit Crypto</h4>
                </div>
                <div class="card-body">
                    <div>


                        <form method="POST" action="{{ route('user.fundActivation') }}">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="hidden" name="network" value="{{ $network }}">
                            <div class="mb-3">


                                <label class="form-label">Wallet Address <svg onclick="copyToClipboard()" class="copy-btn" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        style=""
                                        title="Copy wallet address">
                                        <g opacity="0.6">
                                            <path
                                                d="M14.1666 11.1673V13.6673C14.1666 17.0007 12.8333 18.334 9.49996 18.334H6.33329C2.99996 18.334 1.66663 17.0007 1.66663 13.6673V10.5007C1.66663 7.16732 2.99996 5.83398 6.33329 5.83398H8.83329"
                                                stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M14.1663 11.1673H11.4997C9.49967 11.1673 8.83301 10.5007 8.83301 8.50065V5.83398L14.1663 11.1673Z"
                                                stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M9.66638 1.66602H12.9997" stroke="#fff" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M5.83337 4.16602C5.83337 2.78268 6.95004 1.66602 8.33337 1.66602H10.5167"
                                                stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M18.3337 6.66602V11.8243C18.3337 13.116 17.2837 14.166 15.9921 14.166"
                                                stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M18.3334 6.66602H15.8334C13.9584 6.66602 13.3334 6.04102 13.3334 4.16602V1.66602L18.3334 6.66602Z"
                                                stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </g>
                                    </svg></label>
                                <input id="wallet_address1" type="text" class="form-control"
                                    value="{{ $network }}" readonly style="padding-right: 30px;">




                            </div>

                            <div class="mb-3">
                                <label class="form-label">Currency</label>
                                <input type="text" class="form-control" readonly name="paymentMode"
                                    value="{{ $network == 'USDT_TRX' ? 'USDT(TRC20)' : 'USDT(BEP20)' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" readonly placeholder="" value="{{ $amount }}" name="amount">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    function copyToClipboard() {
        var textBox = document.getElementById("wallet_address1");
        textBox.select();
        document.execCommand("copy");
        iziToast.success({
            message: 'Copied',
            position: "topRight"
        });


    }
</script>

<script>
    function storeTransaction() {

        var orderId = $('#orderId').val();

        $.ajax({
            type: "post",
            url: "https://mega-bot.co/user/checkPaymentStatus",
            data: {
                "orderId": orderId,
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);

                if (response == 1) {
                    iziToast.success({
                        message: 'Deposit Successfully',
                        position: "topRight"
                    });

                    window.setTimeout(function() {
                        window.location.href = 'https://mega-bot.co/user/myWallet';
                    }, 3000);

                }
            }
        });

    }

    // Set the interval to 5 minutes (300,000 milliseconds)
    const interval = 2000;

    // Call the function immediately and then at the specified interval
    storeTransaction(); // Call the function immediately
    setInterval(storeTransaction, interval);
</script>
@include('layouts.upnl.footer')