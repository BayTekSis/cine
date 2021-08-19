<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class ApiController extends Controller
{
    public function test()
    {
        return 'Test is Cong';
    }
public function user(){

    return response()->json(['user'=>User::all()],200);
}
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($data)){
            $token=Auth::user()->createToken('UserToken')->accessToken;


            return response()->json(
                [
                    "status"=>true,"token"=>$token,"user_name"=>Auth::user()->name,"user_id"=>Auth::user()->id
                ]
                ,200);
        }else{
            return response()->json(['status'=>false,'error'=>'Yetkisiz Giriş Denemesi'],200);

        }


    }
    public function logout(Request $request){
        $token=$request->user()->token();
        $token->revoke();
        $response=["success","Güvenli Çıkış Yaptınız."];
        return response()->json($response,200);

//        if(Auth::user()->AauthAcessToken()->delete()){
//            return response()->json(['success'=>'Başarıyla Çıkış Yapıldı'],200);
//
//        }else{
//            return response()->json(['error'=>'Güvenli Çıkış Başarısız'],200);
//
//        }

    }
    public function register(Request $request)
    {

//        $data = $request->validate([
//            'name' => 'required|max:255',
//            'email' => 'required|email',
//            'password' => 'required|confirmed'
//        ]);

        $register_result=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>bcrypt($request->password),
        ]);

        $token = $register_result->createToken('UserToken')->accessToken;

        if ($register_result) {

            return response()->json([ "status"=>true,"token"=>$token,"user_name"=>Auth::user()->name,"user_id"=>Auth::user()->id], 200);
        } else {
            return response()->json(['status'=>false,'error'=>'Kullanıcı kaydı sırasında bir sorun oluştu.'], 400);
        }
    }


    public function cities()
    {
        $data['cinemas'] = Cinema::all();
        $cinema_city_id_raw = [];
        $index = 0;
        foreach ($data['cinemas'] as $cinema) {
            $cinema_city_id_raw[$index] = $cinema->cinema_city_id;
            $index++;
        }
        $cinema_city_id = array_unique($cinema_city_id_raw);
        $data['cities'] = City::whereIn('id', $cinema_city_id)->get();
        return response()->json($data['cities'], 200);
    }

    public function films($city_id, $genre_id, $cinema_id)
    {
        if ($city_id > 0 && $genre_id==0 && $cinema_id==0) {            // 1 0 0
            $film_array_raw = DB::table('cinema_films')
                ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
                ->where('cinema_city_id', $city_id)->select('cinema_film_film_id')->get();
        }else if($city_id==0 && $genre_id>0 && $cinema_id==0){          // 0 1 0

            $film_array_raw = DB::table('cinema_films')
                ->join('films', 'films.id', '=', 'cinema_films.cinema_film_film_id')
                ->where('genre_id', $genre_id)->select('cinema_film_film_id')->get();
        }else if($city_id==0 && $genre_id==0 && $cinema_id>0){          // 0 0 1

            $film_array_raw = DB::table('cinema_films')
                ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
                ->where('cinemas.id', $cinema_id)->select('cinema_film_film_id')->get();
        }else if($city_id > 0 && $genre_id>0 && $cinema_id==0){         // 1 1 0
            $film_array_raw = DB::table('cinema_films')
                ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
                ->join('films', 'films.id', '=', 'cinema_films.cinema_film_film_id')
                ->where('cinema_city_id', $city_id)
                ->where('genre_id', $genre_id)
                ->select('cinema_film_film_id')->get();

        }else if ($city_id > 0 && $genre_id==0 && $cinema_id>0){        // 1 0 1
            $film_array_raw = DB::table('cinema_films')
                ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
                ->where('cinema_city_id', $city_id)
                ->where('cinemas.id', $cinema_id)
                ->select('cinema_film_film_id')->get();

        }else if($city_id==0 && $genre_id>0 && $cinema_id>0 ){          // 0 1 1
            $film_array_raw = DB::table('cinema_films')
                ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
                ->join('films', 'films.id', '=', 'cinema_films.cinema_film_film_id')
                ->where('genre_id', $genre_id)
                ->where('cinemas.id', $cinema_id)
                ->select('cinema_film_film_id')->get();
        }else if($city_id > 0 && $genre_id>0 && $cinema_id>0 ){         // 1 1 1
            $film_array_raw = DB::table('cinema_films')
                ->join('cinemas', 'cinemas.id', '=', 'cinema_films.cinema_film_cinema_id')
                ->join('films', 'films.id', '=', 'cinema_films.cinema_film_film_id')
                ->where('cinema_city_id', $city_id)
                ->where('genre_id', $genre_id)
                ->where('cinemas.id', $cinema_id)
                ->select('cinema_film_film_id')->get();
        }else if($city_id == 0 && $genre_id==0 && $cinema_id==0){
            $film_array_raw = DB::table('cinema_films')
                ->select('cinema_film_film_id')->get();
        }
        else{
            return abort(404);
        }

        $film_array = [];
        foreach ($film_array_raw as $far) {
            array_push($film_array, $far->cinema_film_film_id);
        }
        $film_array_result = array_unique($film_array);

        $filtered_films = DB::table('films')
            ->whereIn('films.id', $film_array_result)
            ->join('genres', 'genres.id', '=', 'films.genre_id')
            ->select('film_file', 'film_name', 'film_slug', 'genre_name', 'film_rate')
            ->get();

        return response()->json($filtered_films, 200);
    }

    public function film_cities($film_id){


        $film_array_raw=DB::table('cinema_films')
            ->join('cinemas','cinemas.id','=','cinema_films.cinema_film_cinema_id')
            ->where('cinema_film_film_id',$film_id)
            ->get();
            $film_array = [];
        foreach ($film_array_raw as $far) {
            array_push($film_array, $far->cinema_city_id);
        }

        $film_array_result = array_unique($film_array);

        $city_result=DB::table('cities')->whereIn('id',$film_array_result)->get();

        return response()->json($city_result, 200);
    }

    public function tickets(Request $request){

       return response()->json($request,200);
    }

    public function ticket_register(Request $request){
        if ($request->seat_numbers==null) return response()->json(['error'=>'Bilet Satın Alabilmek İçin En Az Bir Koltuk Seçmelisiniz.']);
//        if (Auth::user()==null) return response()->json(['error'=>'Lütfen Giriş Yapınız.']);
        $user_id=$request->user_id;
        $user=User::where('id',$user_id)->first();
        $seat_numbers_raw=explode(',',$request->seat_numbers);
        $seat_numbers=[];
        $cine_film_numbers_raw=[];
        foreach($seat_numbers_raw as $item){
            array_push($seat_numbers,explode('-seat-',$item)[1]);
            array_push($cine_film_numbers_raw,explode('-seat-',$item)[0]);

        }
        $cine_film_number=array_unique($cine_film_numbers_raw);
        if(sizeof($cine_film_number)!=1){
            return response()->json(['error'=>'Lütfen Bir Seanstan Bilet Alınız.']);
        }
        $cinema_film=DB::table('cinema_films')->where('id',$cine_film_number)->first();

        $ticket_results=[];
        if(DB::table('tickets')->where('ticket_cinema_film_id',$cinema_film->id)->whereIn('ticket_seat_id',$seat_numbers)->exists()){
            return response()->json(['error'=>'Bu Koltuk Daha Önceden Satın Alınmış']);
        }
        foreach ($seat_numbers as $sn){

            $ticket_result=DB::table('tickets')->insertGetId(
                [
                    "ticket_user_id"=>$user_id,
                    "ticket_cinema_id"=>intval($cinema_film->cinema_film_cinema_id),
                    "ticket_film_id"=>intval($cinema_film->cinema_film_film_id),
                    "ticket_seance_id"=>intval($cinema_film->cinema_film_seance_id),
                    "ticket_seat_id"=>intval($sn),
                    "ticket_cinema_film_id"=>intval($cinema_film->id),
                ]
            );
            $re_new=DB::table('ticket_seats')->insert([
                    "ticket_seats_cinema_film_id"=>intval($cinema_film->id),
                    "ticket_seats_seat_id"=>intval($sn),
                    "ticket_seats_ticket_id"=>$ticket_result,
            ]);
                array_push($ticket_results,$ticket_result);
        }
        $response=DB::table('tickets')
            ->join('cinemas','cinemas.id','=','tickets.ticket_cinema_id')
            ->join('films','films.id','=','tickets.ticket_film_id')
            ->join('seances','seances.id','=','tickets.ticket_seance_id')
            ->join('seats','seats.id','=','tickets.ticket_seat_id')
            ->join('users','users.id','=','tickets.ticket_user_id')
            ->join('cinema_films','cinema_films.id','=','tickets.ticket_cinema_film_id')
            ->select(
                'cinemas.cinema_name',
                'films.film_name',
                'films.film_price',
                'films.film_file',
                'seances.seance_time',
                'seats.seat_name',
                'users.name',
                'cinema_films.cinema_film_date_start'
            )
            ->whereIn('tickets.id',$ticket_results)
            ->get();
        return response()->json($response,200);
    }
    public function mytickets(Request $request){
        $user_id=intval($request->user_id);
        $response=DB::table('tickets')
            ->join('cinemas','cinemas.id','=','tickets.ticket_cinema_id')
            ->join('films','films.id','=','tickets.ticket_film_id')
            ->join('seances','seances.id','=','tickets.ticket_seance_id')
            ->join('seats','seats.id','=','tickets.ticket_seat_id')
            ->join('users','users.id','=','tickets.ticket_user_id')
            ->join('cinema_films','cinema_films.id','=','tickets.ticket_cinema_film_id')
            ->select(
                'tickets.id as ticket_id',
                'cinemas.cinema_name',
                'films.film_name',
                'films.film_price',
                'films.film_file',
                'seances.seance_time',
                'seats.seat_name',
                'users.name',
                'cinema_films.cinema_film_date_start'
            )
            ->where('ticket_user_id',$user_id)
            ->get();
        return response()->json($response,200);

    }

}
