<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,user-scalable=no">
    <title>{{siteName()}} - Request password reset</title>
    <meta name="csrf-param" content="_csrf">
    <link href="index.html" rel="canonical">
    <link type="image/x-icon" href="../favicon3860.ico?v=1" rel="shortcut icon">
    <link type="image/png" href="../favicon.png" rel="icon">
    <link href="{{ asset('') }}assets/c20a81c4/fonts/icomoon/style985d.css?v=1634350014" rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/fonts/stylesheet11f1.css?v=1634187776" rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/css/jquery-ui.min11f1.css?v=1634187776" rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/css/selectric11f1.css?v=1634187776" rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/css/jquery.mCustomScrollbar11f1.css?v=1634187776" rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/css/ion.rangeSlider11f1.css?v=1634187776" rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/css/ion.rangeSlider.skinSimple94b9.css?v=1700299396"
        rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/css/slick11f1.css?v=1634187776" rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/css/style7d51.css?v=1700506980" rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/css/responsived706.css?v=1701345157" rel="stylesheet">
    <link href="{{ asset('') }}assets/c20a81c4/css/alert9b0b.css?v=1627541768" rel="stylesheet">
</head>

<body>
    <script src="{{ asset('') }}assets/b808595e/jquery.mincba3.js?v=1669716178"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/jquery-3.3.1.min11f1.js?v=1634187776"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/jquery-ui.min11f1.js?v=1634187776"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/detect.min11f1.js?v=1634187776"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/clipboard.min11f1.js?v=1634187776"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/slick.min11f1.js?v=1634187776"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/jquery.selectric.min11f1.js?v=1634187776"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/jquery.mCustomScrollbar11f1.js?v=1634187776"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/ion.rangeSlider.min11f1.js?v=1634187776"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/clock2eb3.js?v=1640874314"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/modal11f1.js?v=1634187776"></script>
    <script src="{{ asset('') }}assets/c20a81c4/js/script5b51.js?v=1699953866"></script>




    <section class="wrapper">
        <div class="loginPage" style="background-image: url(/assets/c20a81c4/img/bgwhy.png);">
            <div class="loginForm">
                <form id="request-password-reset-form" action="{{route('submitResetPassword')}}" method="post">
                   {{ csrf_field() }}
                    <div class="formBl">
                        <div class="logo invisLink">
                            <a href="{{ route('Index') }}"></a>
                            <img src="/assets/c20a81c4/img/logo.png" alt="">
                        </div>
                        <span class="title">Reset New Password</span>
                        <span class="sub-title">Please, submit your e-mail address to get further instructions to reset
                            your password.</span>
                        <div class="inputList">
                            <div class="error-summary" style="display:none">
                                <p>Please fix the following errors:</p>
                                <ul></ul>
                            </div>
                            <div class="inputLine field-passwordresetrequestform-email required">
                                <input type="text" id="passwordresetrequestform-email" class="form-control"
                                    name="password" autofocus placeholder="New Password"
                                    aria-required="true"><span class="icViewPass iconBl icon-lock"></span>
                                     
                            </div>
                            <div class="inputLine field-passwordresetrequestform-email required">
                                <input type="text" id="passwordresetrequestform-email" class="form-control"
                                    name="password_confirmation" autofocus placeholder="Confirm New Password"
                                    aria-required="true"><span class="icViewPass iconBl icon-lock"></span>
                                     
                            </div>
                          
                        </div>
                        <div class="form-group field-check3">
                            <input type="hidden" id="check3" class="form-control"
                                name="PasswordResetRequestForm[check]" value="">
                        </div> <button class="btn btnBlue" style="margin-top:-5px; margin-bottom:30px" type="submit"
                            onclick="document.getElementById('check3').value = 'nospam';">Submit</button>
                </form>
                <div class="links">
                    <a href="{{ route('login') }}" class="link">Login</a>
                    <a href="{{ route('register') }}" class="link">Sign up</a>
                </div>
            </div>
        </div>
        </div>
    </section>
    <div class="modalsScroll">
        <div class="modals table">
            <div class="middle tCell">
                <span class="closeModal">
                    <span></span>
                    <span></span>
                </span>
                <div class="blockMod" id="modal_error">
                    <div class="in">
                        <div class="modalsContent">
                            <div class="grayBl">
                                <span class="iconCircle icon-plus"></span>
                                <span class="title">Error</span>
                                <div class="modalSend">
                                    <ul class="txt" id="error-message" style="text-align: center;"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlayModal"></div>
    </div>

 @include('partials.notify')
 
 <script>
        function show_error() {
            $(document).find('.error-summary ul').each(function() {
                if (!$(this).is(':empty')) {
                    error = $(this).html();
                    $(this).html('');
                    $('#error-message').html(error);
                    modalEventOpen('modal_error');
                }
            })
        }


        $(document).on("ajaxComplete", function() {
            show_error();
        });
        show_error();
    </script>


    <script src="{{ asset('') }}assets/9d244e36/yiicba3.js?v=1669716178"></script>
    <script src="{{ asset('') }}assets/9d244e36/yii.captchacba3.js?v=1669716178"></script>
    <script src="{{ asset('') }}assets/9d244e36/yii.activeFormcba3.js?v=1669716178"></script>
    <script>
        jQuery(function($) {
            jQuery('#passwordresetrequestform-code-image').yiiCaptcha({
                "refreshUrl": "\/site\/captcha\/?refresh=1",
                "hashKey": "yiiCaptcha\/site\/captcha"
            });
            jQuery('#request-password-reset-form').yiiActiveForm([{
                "id": "passwordresetrequestform-email",
                "name": "email",
                "container": ".field-passwordresetrequestform-email",
                "input": "#passwordresetrequestform-email",
                "enableAjaxValidation": true,
                "validateOnChange": false,
                "validateOnBlur": false
            }, {
                "id": "passwordresetrequestform-code",
                "name": "code",
                "container": ".field-passwordresetrequestform-code",
                "input": "#passwordresetrequestform-code",
                "enableAjaxValidation": true,
                "validateOnChange": false,
                "validateOnBlur": false
            }], []);
        });
    </script>
</body>

</html>
