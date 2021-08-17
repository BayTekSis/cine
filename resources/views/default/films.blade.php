@extends('layout')

@section('films')

    <section class="section section--first section--bg" data-bg="/default/img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Filmler</h2>
                        <!-- end section title -->
                        <input type="hidden" class="city_id" value="0">
                        <input type="hidden" class="cinema_id" value="0">
                        <input type="hidden" class="genre_id" value="0">
                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="/">Anasayfa</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Filmler</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="filter">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filter__content">
                        <div class="filter__items">
                            <!-- filter item -->
                            <div class="filter__item" id="filter__city">
                                <span class="filter__item-label">Şehir:</span>

                                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-city" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="TÜM ŞEHİRLER">
                                    <span></span>
                                </div>

                                <ul id="filter__city_ul" class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-city">
                                   <li id="city_id-0">TÜM ŞEHİRLER</li>
                                    @foreach($data['cities'] as $city)
                                        <li id="city_id-{{$city->id}}">{{$city->city_name}}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="filter__item" id="filter__genre">
                                <span class="filter__item-label">TÜRÜ:</span>

                                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="HEPSİ">
                                    <span></span>
                                </div>

                                <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-genre">
                                    <li id="genre_id-0">HEPSİ</li>
                                   @foreach($data['genres'] as $genre)
                                    <li id="genre_id-{{$genre->id}}">{{$genre->genre_name}}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="filter__item" id="filter__cinema">
                                <span class="filter__item-label">SİNEMA:</span>

                                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-cinema" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="TÜMÜ">
                                    <span></span>
                                </div>

                                <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-cinema" style="min-width: 250px!important;">
                                   <li id="cinema_id-0">TÜMÜ</li>
                                    @foreach($data['cinemas'] as $cinema)
                                        <li id="cinema_id-{{$cinema->id}}">{{$cinema->cinema_name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end filter item -->

                            <!-- filter item -->
{{--                            <div class="filter__item" id="filter__quality">--}}
{{--                                <span class="filter__item-label">QUALITY:</span>--}}

{{--                                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-quality" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    <input type="button" value="HD 1080">--}}
{{--                                    <span></span>--}}
{{--                                </div>--}}

{{--                                <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-quality">--}}
{{--                                    <li>HD 1080</li>--}}
{{--                                    <li>HD 720</li>--}}
{{--                                    <li>DVD</li>--}}
{{--                                    <li>TS</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                            <!-- end filter item -->

                        </div>

                        <!-- filter btn -->
{{--                        <button class="filter__btn" type="button">FİLTRELE</button>--}}
                        <!-- end filter btn -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="catalog">
        <div class="container">
            <div class="row" id="film_area">
                <!-- card -->
              @foreach($data['films'] as $film)
                <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="/images/{{$film->film_file}}" alt="{{$film->film_name}}">
                            <a href="/{{$film->film_slug}}" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="/{{$film->film_slug}}">{{$film->film_name}}</a></h3>
                            <span class="card__category">
								<a href="#">{{$film->genre_name}}</a>
							</span>
                            <span class="card__rate"><i class="icon ion-ios-star"></i>{{$film->film_rate}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
                <!-- end card -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            $('.filter__btn').click(function (){
                var sehir=$("ul[id*=myid] li").text();
                // var sehir=$('#filter__city_ul').selected();
                console.log('sehir Bilgisi:'+sehir)
                alert('tıkladılaar:'+sehir);
            });
            $('#filter__city_ul').click(function () {
               var text=$(this).text();
            });

        });
    </script>
@endsection

@section('css')@endsection
@section('js')@endsection

