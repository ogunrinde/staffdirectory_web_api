<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\diocean_officials;
use DB;
use Carbon\Carbon;
use App\User;
use App\Diocese;
use App\Brief;
use App\official;
use App\Parish;
use App\Profile;
use App\Province;
use App\Archdeaconary;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class apiController extends Controller
{
    public function signup(Request $request){
        $request->validate([
          'name'=> 'required|string',
          'email' => 'required|string|email|unique:users',
          'password'=>'required|string|confirmed'
         ]);
        //return response()->json(['message'=>'1'],201);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save())
          return response()->json(['message'=>'1']);
        else
          return response()->json(['message'=>'0']);  
    }
    public function getEmail(Request $request){
        //return response()->json(['email_id'=>$request->email]);
        $request->validate([
          'email' => 'required',
         ]);
        //return response()->json(['message'=>'1'],201);
        $user = User::where('email','=',$request->email)->first();
        if(isset($user->email)) return response()->json(['email_id'=>$user->id]);
        else return response()->json(['email_id'=>$user]);
     }
     public function reset(Request $request){
        //return response()->json(['email_id'=>$request->email]);
        $request->validate([
          'password'=>'required',
          'email_id'=>'required'
         ]);
        $password = Hash::make($request->password);
        //return response()->json(['message'=>'1'],201);
        $user = User::where('id','=',$request->email_id)->update(['password'=>$password]);
        return response()->json(['message'=>$user]);
     }
    public function login(Request $request){
        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials)) return response()->json(['message'=>'unauthorized'], 401);
        $user = $request->user();
        $archdeaconaries = Archdeaconary::all();
        $officials = diocean_officials::all();
        $dioceses = Diocese::all();
        $parishes = Parish::all();
        $profiles = Profile::all();
        $provinces = Province::all();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if($request->remember_me) 
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        if($request->user()->expiration_date != '' && strtolower($request->user()->expiration_date) >= strtolower(date('Y-m-d'))){
            return response()->json(['access_token'=> $tokenResult->accessToken, 'token_type' => 'Bearer', 'expires_at'=>
          Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
          'archdeaconaries'=>$archdeaconaries,'officials'=>$officials,'dioceses'=>$dioceses, 'parishes'=>$parishes, 'profiles'=>$profiles,'provinces'=>$provinces]);
        }else{
          return response()->json(['message'=>'subscription expired','email'=>$request->user()->email], 401);
        }
        
    }
    public function user(Request $request){
         return response()->json($request->user());
    }
}
