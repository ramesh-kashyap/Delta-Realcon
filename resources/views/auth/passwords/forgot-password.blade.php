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
                        Forgot Password
                    </h1>
                </div>

                <div class="forgot">
                    <form action="" method="post" class="form">
                        <div class="form__decoration">
                            <picture>
                                <source srcset="{{ asset('') }}frontend/img/cabinet/figure/forgot.webp" type="image/webp">
                                <img src="{{ asset('') }}frontend/img/cabinet/figure/forgot.png" width="364" height="420" alt="figure">
                            </picture>
                        </div>

                        <div class="bg__desktop">
                            <!--<img class="icon-svg" src="{{ asset('') }}frontend/img/bg/form-forgot.svg" alt="form">-->
                        </div>

                        <div class="bg__mobile">
                            <!--<img class="icon-svg" src="{{ asset('') }}frontend/img/bg/form-forgot-mob.svg" alt="form">-->
                        </div>

                        <div class="bg__mobile--small">
                            <!--<img class="icon-svg" src="{{ asset('') }}frontend/img/bg/form-forgot-mob-small.svg" alt="form">-->
                        </div>

                        <div class="form__input">
                            <p>
                                Enter active email from your current account
                            </p>

                            <label class="bg-input">
                                <div class="gradient__violet">
                                    <img class="icon-svg" src="{{ asset('') }}frontend/img/gradient/gradient-violet-plan.svg" alt="gradient">
                                </div>

                                <div class="bg-input__icon">
                                    <img class="icon-svg" src="{{ asset('') }}frontend/img/icons/email.svg" alt="icon">
                                </div>
                                <input type="email" name="email2" placeholder="Email">
                            </label>
                        </div>




                        <button type="submit" class="btn-registration">
                            <div class="gradient__btn">
                                <img class="icon-svg" src="{{ asset('') }}frontend/img/gradient/gradient-btn.svg" alt="gradient">
                            </div>

                            <span>
                                Reset pasword
                            </span>
                        </button>

                        <div class="global__small--text">
                            <p>
                                <a href="login">Go Back to Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main>


@include('layouts.mainsite.footer')