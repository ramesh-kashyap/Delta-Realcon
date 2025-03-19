@include('layouts.upnl.header')

<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deposit </h4>
                </div>
                <div class="card-body">
                    <div>
      


                        <form method="POST" action="{{ route('user.fundActivation') }}">
                            @csrf

                            <div class="mb-3 text-center">
                                <h4>Deposit</h4>

                                @if($network == 'usdtBep20')
                                <div class="d-flex justify-content-center">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $network }}&format=png" class="img-fluid">
                                </div>
                                @endif
                            </div>

 @if($network == 'bank-transfer' && $bankDetails)
<div style="background-color:#f6fbf8 !important" class="mb-3 p-3 border rounded bg-light">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label"> Company Ac. Number</label>
            <input type="text" class="form-control" name="account_no" readonly value="{{ $bankDetails->account_no }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">IFSC Code</label>
            <input type="text" class="form-control" name="ifsc_code" readonly value="{{ $bankDetails->ifsc_code }}">
        </div>
        <div class="col-md-6 mt-3">
            <label class="form-label">Branch Name</label>
            <input type="text" class="form-control" name="branch_name" readonly value="{{ $bankDetails->branch_name }}">
        </div>
        <div class="col-md-6 mt-3">
            <label class="form-label">Bank Name</label>
            <input type="text" class="form-control" name="bank_name" readonly value="{{ $bankDetails->bank_name }}">
        </div>
    </div>
</div>
@endif
 <div class="mb-3">
    <label class="form-label">Amount(1 Unit = {{currency()}} 10000)</label>
    <input type="number" class="form-control" value="{{ $amount }}" readonly name="amount">
</div>

<div class="mb-3">
    <label class="form-label">Currency</label>
    <input type="text" class="form-control" name="network" readonly value="{{strtoupper($network) }}">
</div>


                            @if($network == 'usdtBep20' && $wallet_address)
                            <div class="mb-3">
                                <label class="form-label">Wallet Address</label>
                                <input type="text" class="form-control" name="wallet_address" readonly value="{{ $wallet_address }}">
                            </div>
                            @endif



                            <div class="mb-3">
                                <label class="form-label">Transaction Hash</label>
                                <input type="text" class="form-control" placeholder="enter transaction id" name="txHash">

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Reciept</label>
                                <input type="file" class="form-control" placeholder="upload reciep" value="" name="account">

                            </div>

                            <div class="text-center">
                                <button style="padding:0.5rem 10rem" type="submit" class="btn btn-primary mt-3">Deposit</button>
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

    const interval = 2000;

    // Call the function immediately and then at the specified interval
    storeTransaction(); // Call the function immediately
    setInterval(storeTransaction, interval);
</script>
@include('layouts.upnl.footer')