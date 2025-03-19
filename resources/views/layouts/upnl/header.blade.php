<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="admin, dashboard">
    <meta name="author" content="{{siteName()}}">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Unlock the cosmos of crypto possibilities with {{siteName()}} – Your Gateway to Limitless Trading Horizons. Seamlessly navigate the galaxies of digital assets, where innovation meets opportunity. Join {{siteName()}}AI, where trades transcend boundaries">
    <meta property="og:title" content="{{siteName()}} - The Next Gen Tradinglate">
    <meta property="og:description" content="Unlock the cosmos of crypto possibilities with {{siteName()}} – Your Gateway to Limitless Trading Horizons. Seamlessly navigate the galaxies of digital assets, where innovation meets opportunity. Join {{siteName()}}AI, where trades transcend boundaries">
    <meta property="og:image" content="{{asset('')}}user/images/logo.svg">
    <title>{{ siteName() }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="56x56" href="{{asset('')}}icon/fav.png">
    <link href="{{asset('')}}user/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="{{asset('')}}user/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{asset('')}}user/css/style.css" rel="stylesheet">
    <link href="{{asset('')}}user/iziToast.min.css" rel="stylesheet">
    <link href="{{asset('')}}user/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#navigation-control').click(function() {
                $("#user_button").toggle();
            });
        });
    </script>
    <style>
        /* Hide brand logo on devices with max-width 767px (typical mobile devices) */

        .mobile-view {
            display: none !important;
        }

        @media only screen and (max-width: 600px) {
            .desktop-view {
                display: none !important;
            }

            .mobile-view {
                display: block !important;
            }
        }

        .text-danger {
            --bs-text-opacity: 1;
            color: rgb(255 114 114) !important;
        }

        iframe {
            border: 0;
            display: none;
        }
    </style>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="#" class="brand-logo desktop-view">



                <img src="{{asset('') }}user/images/logo.png" style="width:80px" alt="" id="user_button">


            </a>

            <a href="#" class="brand-logo mobile-view">
                <img src="{{asset('') }}icon/logo.png" style="width: 55px;margin: 10px;" alt="" id="user_button">
            </a>
            <div class="nav-control" id="navigation-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->

        <!--**********************************
            Chat box End
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Dashboard
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
                                <div class="input-group search-area ms-auto d-inline-flex">
                                    <input type="text" class="form-control" placeholder="Search here">
                                    <div class="input-group-append">
                                        <button type="button" class="input-group-text"><i class="flaticon-381-search-2"></i></button>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    @php
                                    $firstLetter = strtoupper(substr(auth()->user()->name, 0, 1));
                                    @endphp
                                    <span style="display: inline-block; width: 40px; height: 40px; line-height: 40px; text-align: center; border-radius: 50%; background-color: #13B497; color: white; font-weight: bold; font-size: 18px;">
                                        {{ $firstLetter }}
                                    </span>


                                    <div class="header-info">
                                        <span>{{ Auth::user()->name }}<i class="fa fa-caret-down ms-3" aria-hidden="true"></i></span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{  route('user.profile')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Profile </span>
                                    </a>
                                    <a href="{{  route('user.ChangePass')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span class="ms-2">Change Password</span>
                                    </a>


                                    <a href="{{  route('logout')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="{{ route('user.dashboard') }}" aria-expanded="false">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>

                    </li>
                    <!-- <li>
						<a   href="{{route('user.wallets')}}" aria-expanded="false">
							<i class="flaticon-381-id-card"></i>
							<span class="nav-text">Wallets Overview</span>
						</a>
                       
                    </li> -->
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                            <i class="fas fa-id-card"></i>
                            <span class="nav-text">Personal Profile </span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('user.profile') }}">Edit Profile</a></li>
                            <li><a href="{{  route('user.ChangePass')}}">Security</a></li>


                        </ul>
                    </li>

                    {{-- <li>
						<a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
							<i class="flaticon-381-id-card-4"></i>
							<span class="nav-text">OPX Wallet</span>
						</a>
                        <!-- <ul aria-expanded="false">
							<li><a href="{{ route('user.opxswap') }}">OPX Swap</a></li>
                    <li><a href="{{ route('user.opxlocked') }}">Locked OPX Coins</a></li>
                    <li><a href="{{ route('user.opxreleased') }}">Released OPX Coins</a></li>
                </ul> -->
                </li> --}}
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="fas fa-id-card"></i>
                        <span class="nav-text">My Network </span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('user.refer') }}">Refer and Earn</a></li>
                        <li><a href="#">Referral Team</a></li>
                        <li><a href="#">Level Team</a></li>


                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="false">
                        <i class="fas fa-id-card"></i>
                        <span class="nav-text">Profit Summary</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('user.roi-bonus')}}">ROI Bonus</a></li>
                        <li><a href="{{route('user.level-income')}}">Level Bonus</a></li>
                        <li><a href="{{route('user.direct-bonus')}}">Direct Bonus</a></li>


                    </ul>
                </li>

                <li><a class=" ai-icon" href="#" aria-expanded="false">
                        <i class="flaticon-381-list"></i>
                        <span class="nav-text">Reward Achievement</span>
                    </a>

                </li>

                <li><a href="{{ route('user.withdrawinfo') }}" aria-expanded="false">
                        <i class="flaticon-381-list"></i>
                        <span class="nav-text">Withdrawal Info</span>
                    </a>

                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void(0);" aria-expanded="true">
                        <i class="fas fa-check-circle status"></i>
                        <span class="nav-text">Status</span>
                    </a>
                    <ul aria-expanded="false" class="" style="">
                        <li><a href="{{route('user.withdrawalstatus')}}">Withdrawal Status</a></li>
                        <li><a href="{{route('user.Depositstatus')}}">Deposit Status</a></li>
                        <li><a href="{{route('user.ticket-status')}}">Ticket Status</a></li>

                    </ul>
                </li>
                <li><a href="{{route('user.ticket')}}" aria-expanded="false">
                        <i class="fas fa-life-ring support"></i>
                        <span class="nav-text">Support</span>
                    </a>

                </li>
                <li><a href="{{asset('logout')}}" aria-expanded="false">
                        <i class="fas fa-sign-out-alt logout"></i>
                        <span class="nav-text">Logout</span>
                    </a>

                </li>
                </ul>


            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->