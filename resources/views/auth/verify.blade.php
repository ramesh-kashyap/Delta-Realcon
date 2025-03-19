@include('layouts.mainsite.header')
    <main>
        <section class="other">
            <div class="other__decoration">
                <picture>
                    <source srcset="{{ asset('') }}frontend/img/bg/bg-main-other.webp" type="image/webp">
                    <img src="{{ asset('') }}frontend/img/bg/bg-main-other.jpg" width="2075" height="1384" alt="background">
                </picture>

                <img class="icon-svg" src="{{ asset('') }}frontend/img/gradient/gradient-main-other.svg" alt="decoration">
            </div>

            <div class="wrapper">
                <div class="other__hedaer">
                    <h1>
                        Register Successfully
                    </h1>
                </div>

                <div class="login">
                    <form action="{{ route('login') }}" method="post" class="form">

                        {{ csrf_field() }}
                        <div class="form__decoration">
                            <picture>
                                <source srcset="{{ asset('') }}frontend/pic/figure/login.webp" type="image/webp">
                                <img src="{{ asset('') }}frontend/pic/figure/login.png" width="498" height="306" alt="figure">
                            </picture>
                        </div>

                        <div class="bg__desktop">
                            <!--<img class="icon-svg" src="{{ asset('') }}frontend/img/bg/form-login.svg" alt="form">-->
                        </div>

                        <div class="bg__mobile">
                            <!--<img class="icon-svg" src="{{ asset('') }}frontend/img/bg/form-login-mob.svg" alt="form">-->
                        </div>

                        <div class="bg__mobile--small">
                            <!--<img class="icon-svg" src="{{ asset('') }}frontend/img/bg/form-login-mob-small.svg" alt="form">-->
                        </div>

                        <div class="form__input" style="    font-size:20px;">
                            

                            @if(session()->has('messages'))
                            <?php
                            $user_details=session()->get('messages')
                        ?>



                            <h4 style="color: ##000">Congratulations! Your Account has been successfully
                                Created.</h4>
                            <br>

                            <h4 style="color: ##000">Dear <span class="main-color"
                                    style="color: #ffc70d;font-weight: 700;">{{$user_details->name }}</span>,
                            </h4>
                            <br>
                            <h4 style="color: ##000"> You have been successfully registered. <br> Your
                                user id is <span class="main-color"
                                    style="    color: #ffc70d;font-weight: 700;">{{$user_details->username  }}</span>
                                Password is: <span class="main-color"
                                    style="color: #ffc70d;font-weight: 700;">
                                    {{$user_details->PSR  }}</span> and Transaction Password is: <span
                                    class="main-color" style="color: #ffc70d;font-weight: 700;">
                                    {{$user_details->TPSR  }}</span>
                                please check your mail for more details.</h4>

                            @endif

                        </div>


                       


                        <a href="{{route('login')}}" class="btn-registration">
                            <div class="gradient__btn">
                                <img class="icon-svg" src="{{ asset('') }}frontend/img/gradient/gradient-btn.svg" alt="gradient">
                            </div>

                            <span>
                                Login
                            </span>
                        </a>

                      
                    </form>
                </div>
            </div>
        </section>

    </main>
@include('partials.notify')

    @include('layouts.mainsite.footer')
