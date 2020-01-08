<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Profile;
use App\payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function payment(){
        return view('home.payment');
    }
    public function updatepayment(Request $request){
        $payment = new payment();
        $expiration_date = '31-12-'.date('Y').'';
        $payment->email = Auth::user()->email;
        $payment->reference = $request->reference;
        $payment->message = $request->message;
        $payment->status = $request->status;
        $payment->transaction = $request->transaction;
        $payment->expiration_date = $expiration_date;
        $payment->date_created = date('Y-m-d');
        $payment->amount = 1000;
        if($payment->save()){
            $edit = DB::table('users')
                ->where('email',Auth::user()->email)
                ->update(['expiration_date'=> $expiration_date]);
                return redirect()->back()->with('message', 'Payment Successful, your current subscription will expire on '.$expiration_date.'');
        }
    }
    public function index()
    {
        //return dd('a');
        if(strtotime(Auth::user()->expiration_date) <= strtotime(date('Y-m-d')))
            return view('home.payment');
        //if(!isset($priest_id)) return view('profile.index');
        $users = [];
        $priest = DB::table('profiles')
            ->join('dioceses','dioceses.id','=','profiles.current_diocese')
            ->join('provinces','provinces.id','=','profiles.current_province')
            ->join('archdeaconaries','archdeaconaries.id','=','profiles.current_archdeaconary')
            ->select('*')
            ->where('profiles.user_id','=',Auth::user()->id)
            ->get();
        $provinces = DB::table('provinces')
            ->select('*')
            ->get();
        $dioceses = DB::table('dioceses')
            ->select('*')
            ->get();
        $searchparam = Session::get('searchparam'); 
        if(isset($searchparam)){
            $users = DB::table('profiles')
                    ->where('status', '=', $searchparam)
                    ->orWhere('firstname', $searchparam)
                    ->get(); 
        }   
        //return $users; 
        //return view('profile.index',['provinces'=>$provinces,'priest'=>$priest]);
            return view('home.index',['provinces'=>$provinces,'users'=>$users,'dioceses'=>$dioceses]);
    }
}
