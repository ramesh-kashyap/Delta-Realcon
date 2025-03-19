<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Withdraw Crypto</h4>
                </div>
                <div class="card-body">
                    <div>
                        <p class="text-warning">Withdrawal Request Can Take Upto 2-3 days To Reflect In Your Crypto Wallet.10% Taxes will be deducted.</p>

                        <form method="POST" action="{{ route('user.confirm') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Wallet Address</label>
                                <input type="text" class="form-control" placeholder="Enter Wallet Address" name="wallet_address" readonly value="{{ $walletaddress }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Withdraw Method-</label>
                                <input type="text" class="form-control" placeholder="Enter Withdraw Method" name="withdraw_method" readonly value="{{ $add }}">
                                <input type="hidden" class="form-control"  name="amount"  value="{{ $amt }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Enter OTP send to your registered Email-</label>
                                <input type="number" class="form-control" placeholder="Enter OTP" name="otp" >
                                <p class="text-info">Last updated on {{ $time }}</p>

                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
