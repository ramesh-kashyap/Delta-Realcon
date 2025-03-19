
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard">
	<meta name="author" content="{{siteName()}}">
	<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Unlock the cosmos of crypto possibilities with {{siteName()}} – Your Gateway to Limitless Trading Horizons. Seamlessly navigate the galaxies of digital assets, where innovation meets opportunity. Join {{siteName()}}AI, where trades transcend boundaries">
	<meta property="og:title" content="{{siteName()}} - The Next Gen Trading">
	<meta property="og:description" content="Unlock the cosmos of crypto possibilities with {{siteName()}} – Your Gateway to Limitless Trading Horizons. Seamlessly navigate the galaxies of digital assets, where innovation meets opportunity. Join {{siteName()}}AI, where trades transcend boundaries">
	<!-- <meta property="og:image" content="{{asset('')}}user/images/logo.svg"> -->
	<title>{{ siteName() }} - Automated Trading Bots</title>
    <!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="56x56" href="{{asset('')}}main/images/favicon.png">
	<link href="{{asset('')}}user/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{asset('')}}user/css/style.css" rel="stylesheet">      

    
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
            
          
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="{{ route('Index') }}">
											<!-- <img src="{{asset('')}}user/images/logo.svg" alt="" style="width:100%"> -->
										</a>
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="username" Placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" Placeholder="Password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="form-check custom-checkbox ms-1">
													<input type="checkbox" class="form-check-input" id="basic_checkbox_1"required>
													<label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <div class="form-group">
                                                <a href="{{ route('forgot-password') }}">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn  btn-block"style="
  --tw-bg-opacity: 1;
  background-color: rgb(11 44 61 / var(--tw-bg-opacity));
">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-secondary" href="{{ route('register') }}">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('partials.notify')


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('')}}user/vendor/global/global.min.js"></script>
	<script src="{{asset('')}}user/vendor/bootstrap-select/dist/{{asset('')}}user/js/bootstrap-select.min.js"></script>
    <script src="{{asset('')}}user/js/custom.min.js"></script>
    <script src="{{asset('')}}user/js/deznav-init.js"></script>
	<script src="{{asset('')}}user/js/demo.js"></script>

</body>

</html>