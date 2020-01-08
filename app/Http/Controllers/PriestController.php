<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Session;

class PriestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diocese_id = Session::get('diocese_id');
        $profiles = DB::table('profiles')
            ->select('*')
            ->where('current_diocese','=', $diocese_id)
            ->get();
        $arch = DB::table('archdeaconaries')
            ->select('*')
            ->where('diocese_id','=', $diocese_id)
            ->get(); 
        
        $parishes = DB::table('parishes')
            ->select('*')
            ->where('diocese_id','=', $diocese_id)
            ->get();  
         $rtrev = [];
         $vyrev = [];   
         $ven = [];
         $revcan = [];
         $evang = [];
         $rev = [];
        foreach ($profiles as $k) {
          if( strtolower($k->status) == 'rt. reverend' ){
             $rtrev[] = $k;
          } 
          else if( strtolower($k->status) == 'very reverend' ){
             $vyrev[] = $k;
          } 
          else if( strtolower($k->status) == 'venerable' ){
             $ven[] = $k;
          }
          else if( strtolower($k->status) == 'reverend canon' ){
             $revcan[] = $k;
          }
          else if( strtolower($k->status) == 'reverend' ){
             $rev[] = $k;
          } 
          else if( strtolower($k->status) == 'evangelist' ){
             $evang[] = $k;
          }      
        }   
        //return asort($profiles); 
        //usort($profiles, function($a,$b) { return strcmp($a->surname,$b->surname); });
        //return $profiles;       
        return view('priest.index',['rtrev'=>$rtrev,'vyrev'=>$vyrev,'ven'=>$ven, 'revcan'=>$revcan,'evang'=>$evang, 'rev'=>$rev, 'profiles'=>$profiles,'archdeaconaries'=>$arch,'parishes'=>$parishes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $provinces = DB::table('provinces')
            ->select('*')
            ->get();
       $dioceses = DB::table('dioceses')
            ->select('*')
            ->get();
        $archdeaconary = DB::table('archdeaconaries')
            ->select('*')
            ->get();
        $parishes = DB::table('parishes')
            ->select('*')
            ->get();
        $profile = DB::table('profiles')
            ->select('*')
            ->get();            
        return view('profile.create',['provinces'=>$provinces,'dioceses'=>$dioceses,'archdeaconary'=>$archdeaconary,'parishes'=>$parishes,'profile'=>$profile]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'status' => 'required',
        'firstname' => 'required',
        'surname'=>'required',
        'email_a' =>'required',
        'address' => 'required',
        'phone_number_a' => 'required',
        'province_name'=>'required',
        'diocese_name' =>'required',
        'archdeaconary_name'=>'required',
        'parish_name' =>'required'
        ]);
        $profile = new Profile();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $ext = $image->getClientOriginalExtension();
            $time = time().'.'.$ext;
            $image->move(public_path().'/profile/',$time);
            $profile->image = $time;
        }
        $profile->status = $request->status;
        $profile->firstname = $request->firstname;
        $profile->surname = $request->surname;
        $profile->date_created = date('Y-m-d');
        $profile->middlename = $request->middlename;
        $profile->inserted_by = isset(Auth::user()->id) ? Auth::user()->id : '';
        $profile->email_a = $request->email_a;
        $profile->email_b = $request->email_b;
        $profile->address = $request->address;
        $profile->martial_status = $request->martial_status;
        $profile->dob = $request->dob;
        $profile->position = $request->position;
        $profile->phone_number_a = $request->phone_number_a;
        $profile->phone_number_b = $request->phone_number_b;
        $profile->spouse_name = $request->spouse_name;
        $profile->date_married = $request->date_married;
        $profile->date_deaconed = $request->date_deaconed;
        $profile->date_priested = $request->date_priested;
        $profile->spouse_qualification = $request->spouse_qualification;
        $profile->all_education = $request->all_education;
        $profile->all_perferment = $request->all_perferment;
        $profile->all_parish = $request->all_parish;
        $profile->current_province = $request->province_name;
        $profile->current_diocese = $request->diocese_name;
        $profile->current_archdeaconary = $request->archdeaconary_name;
        $profile->current_parish = $request->parish_name;
        if($profile->save()){
            return redirect('priest/create')->with('message', 'Data Saved Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
