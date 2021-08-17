@extends('layout')

@section('login')

    <div class="sign section--bg" data-bg="/default/img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form action="{{route('api.login')}}" method="post" class="sign__form">
                            @csrf
                            <a href="/" class="sign__logo">
                                <img src="/default/img/logo.svg" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" class="sign__input"  name="email" placeholder="Mail Adresiniz">
                            </div>

                            <div class="sign__group">
                                <input type="password" class="sign__input" name="password" placeholder="Şifreniz">
                            </div>

                            <div class="sign__group sign__group--checkbox">
                                <input id="remember" name="remember" type="checkbox" checked="checked">
                                <label for="remember">Beni Hatırla</label>
                            </div>

                            <button class="sign__btn" type="submit">Giriş Yap</button>

                            <span class="sign__text">Hâlâ Kayıt Olmadınız Mı? <a href="/register">Kaydol!</a></span>

                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')@endsection
@section('js')@endsection

