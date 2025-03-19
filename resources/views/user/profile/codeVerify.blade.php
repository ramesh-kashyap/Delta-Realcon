<!-- main -->
<div class="container-fluid">
    <div class="main row">
        <div class="col-12">
            <div class="dashboard-heading">
                <h4 class="mb-0">Edit Profile</h4>
            </div>

            <section class="profile-setting">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-4">
                        <div class="sidebar-wrapper">
                            <form method="post" action="/user/updateProfile" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="WMHLDRiVajXWstMy5KCxrx8s9sfOXw9ocPafUQsV">
                                <div class="profile">
                                    <div class="img">
                                        <img id="profile" src="assets/uploads/male-avatar-icon-13.jpg"
                                            alt="preview user image" class="img-fluid" />
                                        <button class="upload-img">
                                            <i class="fal fa-camera"></i>
                                            <input class="form-control" accept="image/*" type="file" name="image"
                                                id="image" onchange="previewImage('profile')" />
                                        </button>
                                    </div>


                                    <div class="text">
                                        <h5 class="name">{{Auth::user()->name}}</h5>
                                        <span>{{Auth::user()->email}}</span>
                                        <div>
                                            <button style="display: none" class="btn-custom mt-2 p-2 text-white" type="submit">Submit
                                                Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="profile-navigator">
                                <button tab-id="tab1" class="tab  active">
                                    <i class="fal fa-user"></i> Profile information </button>
                                <button tab-id="tab2" class="tab ">
                                    <i class="fal fa-key"></i> Password setting </button>
                                <button tab-id="tab3" class="tab ">
                                    <i class="fal fa-id-card"></i> Payment Wallet </button>
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                      
                        <div id="tab3" class="content active">
                            <form method="post" action="{{ route('user.wallet_change') }}">
                                {{ csrf_field() }}
                                <div class="row g-4">
                                    <div class="input-box col-md-12">
                                        <label for="">One time password</label>
                                        <input type="text" name="code"   value="" 
                                        placeholder="One time password" class="form-control" />
                                    </div>

                                   
                                    <div class="input-box col-12">
                                        <button class="btn-custom" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="tab4" class="content ">
                            <div class="alert mb-0">
                                <i class="fal fa-check-circle text-success"></i>
                                <span>Your KYC already verified</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


</div>
</div>
</div>
