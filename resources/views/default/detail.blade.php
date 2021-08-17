@extends('layout')
@section('detail')
    <style>
        .accordion__list tr th button {
            width: 50px !important;
        }

        .accordion__list tr th {
            text-align: -webkit-center;
        }

        .filter__btn__disabled {
            color: black;
            font-weight: bold;
            opacity: 0.1;
        }

        .filter_btn_selected {
            background-image: linear-gradient(
                90deg, #52f776 0%, #0ca920 100%) !important;
        }
    </style>
    <section class="section details">
        <!-- details background -->
        <div class="details__bg" data-bg="/default/img/home/home__bg.jpg"></div>
        <!-- end details background -->

        <!-- details content -->
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <h1 class="details__title">{{$data['film']->film_name}}</h1>

                </div>
                <!-- end title -->
                <!-- content -->
                <div class="col-12 col-xl-6">
                    <div class="card card--details">
                        <div class="row">
                            <!-- card cover -->
                            <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-5">
                                <div class="card__cover">
                                    <img src="/images/{{$data['film']->film_file}}" alt="{{$data['film']->film_name}}">
                                </div>
                            </div>
                            <!-- end card cover -->

                            <!-- card content -->
                            <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                <div class="card__content">
                                    <div class="card__wrap">
                                        <span class="card__rate"><i class="icon ion-ios-star"></i>{{$data['film']->film_rate}}</span>

                                        <ul class="card__list">
                                            <li>HD</li>
                                            <li>16+</li>
                                        </ul>
                                    </div>

                                    <ul class="card__meta">
                                        <li><span>Tür:</span> <a href="#">{{$data['film']->genre_name}}</a>
                                        </li>
                                        <li><span>Yapım Tarihi:</span>{{$data['film']->film_release_date}}</li>
                                        <li><span>Film Süresi</span>{{$data['film']->film_duration}} dk</li>
                                    </ul>

                                    <div class="card__description card__description--details">
                                        {{$data['film']->detail}}
                                    </div>
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->

                <!-- player -->
                <div class="col-12 col-xl-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$data['film']->film_trailer}}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>

                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="filter__content">
                                <div class="filter__items">
                                    <!-- filter item -->


                                    <div class="filter__item" id="filter__city">
                                        <span class="filter__item-label">Şehir:</span>

                                        <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-city"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <input type="button" value="{{$data['city_name']}}">
                                            <span></span>
                                        </div>

                                        <ul id="filter__city_ul"
                                            class="filter__item-menu dropdown-menu scrollbar-dropdown"
                                            aria-labelledby="filter-city">
                                            @foreach($data['cities'] as $city)
                                                <li id="detail_city_id-{{$city->id}}">{{$city->city_name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>


                                    <div class="filter__item" id="filter__cinema">
                                        <span class="filter__item-label">SİNEMA:</span>

                                        <div class="filter__item-btn dropdown-toggle" role="navigation"
                                             id="filter-cinema" data-toggle="dropdown" aria-haspopup="true"
                                             aria-expanded="false">
                                            <input type="button" value="{{$data['cinema_name']}}">
                                            <span></span>
                                        </div>

                                        <ul class="filter__item-menu dropdown-menu scrollbar-dropdown"
                                            aria-labelledby="filter-cinema" style="min-width: 250px!important;">
                                            @foreach($data['cinemas'] as $cinema)
                                                <li id="detail_cinema_id-{{$cinema->id}}">{{$cinema->cinema_name}}</li>
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
                                <form action="{{route('ticket.register')}}" method="post">
                                    <input type="hidden" id="film_id" name="film_id" value="{{$data['film']->id}}">
                                    <input type="hidden" id="city_id" name="city_id" value="{{$city->id}}">
                                    <input type="hidden" id="cinema_id" name="cinema_id" value="{{$cinema->id}}">
                                    <input type="hidden" id="seat_numbers" name="seat_numbers" value="">
                                    <button class="filter__btn" type="submit">Satın Al</button>
                                </form>

                                <!-- end filter btn -->
                            </div>
                        </div>
                    </div>
                </div>

                @if($data['film_details']!=null)
                    <div class="col-12 col-xl-12">
                        <div class="accordion" id="accordion">

                            @foreach($data['film_details'] as $detail)
                                <div class="accordion__card">
                                    <div class="card-header" id="heading{{$loop->index}}">
                                        <button type="button" data-toggle="collapse"
                                                data-target="#collapse{{$loop->index}}"
                                                aria-expanded="{{$loop->index==0 ? 'true':'false'}}"
                                                aria-controls="collapse{{$loop->index}}">
                                            <span>Seans: {{$detail->seance_time}}</span>
                                            <span>Tarih : {{$detail->cinema_film_date_start}}</span>
                                        </button>
                                    </div>

                                    <div id="collapse{{$loop->index}}" class="collapse {{$loop->index==0 ? 'show':''}}"
                                         aria-labelledby="heading{{$loop->index}}"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="accordion__list">

                                                <tbody>
                                                @php($exit=false)

                                                @foreach($data['seats'] as $key=>$seat)
                                                    @php($equal=-1)
                                                    @php($equal_name="")

                                                    @if($loop->index%10==0)
                                                        <tr>@endif
                                                            <th>
                                                                @if($detail->ticket_seats!=null)

                                                                    @foreach($detail->ticket_seats as $ticket_seat)


                                                                        @if($ticket_seat->ticket_seats_seat_id==$seat->id)


                                                                           @php($equal=$seat->id)
                                                                           @php($equal_name=$seat->seat_name)
                                                                        @endif



                                                                    @endforeach
                                                                    @if($equal!=-1)
                                                                            <button
                                                                                id="{{$detail->cinema_film_id}}-seat-{{$equal}}"
                                                                                class="filter__btn  filter__btn__disabled">{{$equal_name}}</button>
                                                                        @else
                                                                            <button
                                                                                id="{{$detail->cinema_film_id}}-seat-{{$seat->id}}"
                                                                                class="filter__btn filter__btn_x cinema_seat">{{$seat->seat_name}}</button>
                                                                        @endif


                                                                @else
                                                                    <button
                                                                        id="{{$detail->cinema_film_id}}-seat-{{$seat->id}}"
                                                                        class="filter__btn filter__btn_x cinema_seat">{{$seat->seat_name}}</button>
                                                                @endif

                                                            </th>
                                                            @if($loop->index%10==9) </tr>@endif
                                                @endforeach
                                                <tr>
                                                    <th colspan="10">
                                                        <button class="filter__btn w-100">PERDE</button>
                                                    </th>
                                                </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <!-- end player -->
                @endif
            </div>
        </div>
        <!-- end details content -->
    </section>




@endsection

@section('css')@endsection
@section('js')@endsection
