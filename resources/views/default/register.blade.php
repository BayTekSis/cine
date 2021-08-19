@extends('layout')

@section('register')

    <div class="sign section--bg" data-bg="/default/img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- registration form -->
                        <form action="{{ route('register.post') }}" method="post" class="sign__form">
                            @csrf
                            <a href="/" class="sign__logo">
                                <img src="/default/img/logo.svg" alt="">
                            </a>
                            <div class="sign__group">
                                <input required type="text" name="name" class="sign__input" placeholder="İsim Soyisim">
                            </div>

                            <div class="sign__group">
                                <input required type="email" name="email" class="sign__input" placeholder="Mail Adresi">
                            </div>

                            <div class="sign__group">
                                <input required type="password" name="password" class="sign__input" placeholder="Şifre">
                            </div>

                            <div class="sign__group">
                                <input required type="password" name="password_confirmation" class="sign__input" placeholder="Şifrenizi Doğrulayın">
                            </div>

                            <div class="sign__group sign__group--checkbox">
                                <input id="remember" name="remember" type="checkbox">
                                <label for="remember"><a href="#">Gizlilik Politikanızı</a> Kabul Ediyorum</label>
                            </div>

                            <button class="sign__btn" type="submit">Kaydol</button>

                            <span class="sign__text">Zaten Üye İseniz? <a href="/login">Giriş Yap</a></span>
                        </form>
                        <!-- registration form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')@endsection
@section('js')@endsection

