@extends('layout')
@section('index')
    <section class="home">
        <!-- home bg -->
        <div class="owl-carousel home__bg">
            <div class="item home__cover" data-bg="img/home/home__bg.jpg"></div>
            <div class="item home__cover" data-bg="img/home/home__bg2.jpg"></div>
            <div class="item home__cover" data-bg="img/home/home__bg3.jpg"></div>
            <div class="item home__cover" data-bg="img/home/home__bg4.jpg"></div>
        </div>
        <!-- end home bg -->

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="home__title">SEZONUN <b>EN YENİ</b> FİLMLERİ</h1>

                    <button class="home__nav home__nav--prev" type="button">
                        <i class="icon ion-ios-arrow-round-back"></i>
                    </button>
                    <button class="home__nav home__nav--next" type="button">
                        <i class="icon ion-ios-arrow-round-forward"></i>
                    </button>
                </div>

                <div class="col-12">
                    <div class="owl-carousel home__carousel">


                        @foreach($data['films'] as $film)
                        <div class="item">
                            <!-- card -->
                            <div class="card card--big">
                                <div class="card__cover">
                                    <img src="/images/{{$film->film_file}}" alt="">
                                    <a href="/{{$film->film_slug}}" class="card__play">
                                        <i class="icon ion-ios-play"></i>
                                    </a>
                                </div>
                                <div class="card__content">
                                    <h3 class="card__title"><a href="/{{$film->film_slug}}">{{$film->film_name}}</a></h3>
                                    <span class="card__category">
										<a href="/">{{$film->genre_name}}</a>
									</span>
                                    <span class="card__rate"><i class="icon ion-ios-star"></i>{{$film->film_rate}}</span>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection

@section('css')@endsection
@section('js')@endsection
