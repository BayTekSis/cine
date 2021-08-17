<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\City;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {

        $data['films'] = DB::table('films')->join('genres', 'films.genre_id', '=', 'genres.id')->get();
        return view('default.index', compact('data'));
    }

    public function detail($slug)
    {
        $data['film'] = DB::table('films')->where('film_slug', $slug)->join('genres', 'films.genre_id', '=', 'genres.id')->first();


        $film_array_raw = DB::table('cinema_films')
            ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
            ->where('cinema_film_film_id', $data['film']->id)
            ->get();
        $film_array = [];
        foreach ($film_array_raw as $far) {
            array_push($film_array, $far->cinema_city_id);
        }

        $film_array_result = array_unique($film_array);

        $data['cities'] = DB::table('cities')->whereIn('id', $film_array_result)->get();

        $data['genres'] = Genre::all();
        $data['cinemas'] = Cinema::all();
        $cinema_city_id_raw = [];
        $index = 0;
        foreach ($data['cinemas'] as $cinema) {
            $cinema_city_id_raw[$index] = $cinema->cinema_city_id;
            $index++;
        }
        $cinema_city_id = array_unique($cinema_city_id_raw);
        $data['films'] = DB::table('films')->join('genres', 'films.genre_id', '=', 'genres.id')->get();
        $data['city_name'] = 'TÜM ŞEHİRLER';
        $data['cinema_name'] = 'TÜMÜ';
        $data['film_details'] = null;
        $data['button'] = true;

        return view('default.detail', compact('data'));
    }

    public function detail_city($slug, $city)
    {
        $data['film'] = DB::table('films')->where('film_slug', $slug)->join('genres', 'films.genre_id', '=', 'genres.id')->first();

        $film_array_raw = DB::table('cinema_films')
            ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
            ->where('cinema_film_film_id', $data['film']->id)
            ->get();
        $film_array = [];
        foreach ($film_array_raw as $far) {
            array_push($film_array, $far->cinema_city_id);
        }

        $film_array_result = array_unique($film_array);

        $data['cities'] = DB::table('cities')->whereIn('id', $film_array_result)->get();

        $data['cinemas'] = Cinema::all();


        $cinema_id_query = DB::table('cinema_films')
            ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
            ->where('cinema_film_film_id', $data['film']->id)
            ->where('cinema_city_id', $city)
            ->get();

        $cinema_id_raw = [];
        $index = 0;


        foreach ($cinema_id_query as $cinema) {
            $cinema_id_raw[$index] = $cinema->cinema_film_cinema_id;
            $index++;
        }
        $cinema_id = array_unique($cinema_id_raw);
        $data['cinemas'] = DB::table('cinemas')->whereIn('id', $cinema_id)->get();

        $data['city_name'] = DB::table('cities')->where('id', $city)->value('city_name');
        $data['cinema_name'] = "TÜMÜ";
        $data['film_details'] = null;
        $data['button'] = false;


        return view('default.detail', compact('data'));
    }

    public function detail_cinema($slug, $city, $cinema)
    {
        $selected_cinema = intval($cinema);
        $data['film'] = DB::table('films')->where('film_slug', $slug)->join('genres', 'films.genre_id', '=', 'genres.id')->first();

        $film_array_raw = DB::table('cinema_films')
            ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
            ->where('cinema_film_film_id', $data['film']->id)
            ->get();
        $film_array = [];
        foreach ($film_array_raw as $far) {
            array_push($film_array, $far->cinema_city_id);
        }

        $film_array_result = array_unique($film_array);

        $data['cities'] = DB::table('cities')->whereIn('id', $film_array_result)->get();

        $data['cinemas'] = Cinema::all();


        $cinema_id_query = DB::table('cinema_films')
            ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
            ->where('cinema_film_film_id', $data['film']->id)
            ->where('cinema_city_id', $city)
            ->get();

        $cinema_id_raw = [];
        $index = 0;


        foreach ($cinema_id_query as $cinema) {
            $cinema_id_raw[$index] = $cinema->cinema_film_cinema_id;
            $index++;
        }
        $cinema_id = array_unique($cinema_id_raw);
        $data['cinemas'] = DB::table('cinemas')->whereIn('id', $cinema_id)->get();

        $data['city_name'] = DB::table('cities')->where('id', $city)->value('city_name');

        $data['cinema_name'] = DB::table('cinemas')->where('id', $selected_cinema)->value('cinema_name');

        $data['film_details'] = DB::table('cinema_films')
            ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
            ->join('seances', 'seances.id', '=', 'cinema_films.cinema_film_seance_id')
            ->where('cinema_film_film_id', $data['film']->id)
            ->where('cinema_city_id', $city)
            ->where('cinema_film_cinema_id', $selected_cinema)
            ->select('cinema_films.id as cinema_film_id', 'cinema_films.*', 'cinemas.*', 'seances.id as seance_id', 'seances.*')
            ->orderBy('seance_id')
            ->get();
        foreach ($data['film_details'] as $detail) {
            $detail->ticket_seats = DB::table('ticket_seats')
                ->where('ticket_seats_cinema_film_id', $detail->cinema_film_id)->exists() ?
                DB::table('ticket_seats')
                    ->where('ticket_seats_cinema_film_id', $detail->cinema_film_id)->get() : null;
        }
        $data['button'] = false;
        $data['seats'] = DB::table('seats')->get();
        return view('default.detail', compact('data'));
    }

    public function films()
    {

        $data['genres'] = Genre::all();
        $data['cinemas'] = Cinema::all();
        $cinema_city_id_raw = [];
        $index = 0;
        foreach ($data['cinemas'] as $cinema) {
            $cinema_city_id_raw[$index] = $cinema->cinema_city_id;
            $index++;
        }
        $cinema_city_id = array_unique($cinema_city_id_raw);
        $data['cities'] = City::whereIn('id', $cinema_city_id)->get();
        $data['films'] = DB::table('films')->join('genres', 'films.genre_id', '=', 'genres.id')->get();
        return view('default.films', compact('data'));
    }

    public function login()
    {

        return view('default.login');

    }

    public function register()
    {

        return view('default.register');

    }


}