<!--**********************************
    Content body start
***********************************-->
@include('layouts.upnl.header')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div id="msg" class="px-2 py-1">
            <div class="text-success mb-1" role="alert">
                Refer and Earn To Increase Your Earnings.
            </div>
        </div>
        <div class="row mb-3">
            <div style="padding-top: 60px;" class="col-xl-12 d-md-block">
                <div class="card-green mb-xl-0">
                    <div class="row p-1 py-1 d-flex align-items-center justify-content-between">
                        <div class="col-xl-6 col-12 text-center">
                            <div>
                                <img class="img-fluid" src="{{asset('')}}user/images/refer.webp" style="pointer-events: none;">
                            </div>
                        </div>
                        <div class="card col-xl-6 col-md-6 text-center">
                            <h5 class="card-title pt-1">Refer & Earn</h5>
                            <div class="card-body">
                            <p>REFER and Earn, Get 5% OPX Coins Of Your Friends First OPX Swap And Earn up to 30% of profit commission from your downline.
                            </p>
                            <span>My Refer ID:</span>
                            <h2 class="display-3 text-info">{{ Auth::user()->username }}</h2>
                            <input id="refer_id" readonly class="form-control text-center mb-1" type="text" value="{{ asset('') }}register?ref={{ auth::user()->username }}">
                            <button onclick="copyContent()" type="button" class="btn btn-rounded btn-primary">COPY</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let text = document.getElementById('refer_id').value;
    const copyContent = async () => {
        try {
            await navigator.clipboard.writeText(text);
            setTimeout(() => {
                                iziToast.success({
                                     message: "Refer link copied to clipboard.",
                               position: "topRight"
                                });
                            }, 100);
        } catch (err) {
            setTimeout(() => {
                                iziToast.error({
                                     message: "Failed to copy refer link.",
                               position: "topRight"
                                });
                            }, 100);
        }
    }
</script>

@include('layouts.upnl.footer')

<!--**********************************
    Content body end
***********************************-->
