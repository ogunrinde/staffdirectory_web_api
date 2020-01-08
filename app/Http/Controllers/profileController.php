<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Profile;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return dd('add');
        //return view('profile.index');
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
        //return dd('q');
        $profile = new Profile();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $ext = $image->getClientOriginalExtension();
            $time = rand(100000000000, 99999999999999).'_'.time().'.'.$ext;
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
        $profile->phone_number_a = $request->phone_number_a;
        $profile->phone_number_b = $request->phone_number_b;
        $profile->spouse_name = $request->spouse_name;
        $profile->date_married = $request->date_married;
        $profile->spouse_qualification = $request->spouse_qualification;
        $profile->all_education = $request->all_education;
        $profile->all_perferment = $request->all_perferment;
        $profile->all_parish = $request->all_parish;
        $profile->current_province = $request->province_name;
        $profile->current_diocese = $request->diocese_name;
        $profile->current_archdeaconary = $request->archdeaconary_name;
        $profile->current_parish = $request->parish_name;
        if($profile->save()){
            return redirect('profile/create')->with('message', 'Data Saved Successfully');
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
