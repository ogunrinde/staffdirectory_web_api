<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Parish;
use Illuminate\Support\Facades\Auth;

class parishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parish.index');
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
            //return $archdeaconary;
            //return $provinces;
        return view('parish.create',['provinces'=>$provinces,'dioceses'=>$dioceses,'archdeaconary'=>$archdeaconary,'parishes'=>$parishes]);
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
        'diocese_name' => 'required',
        'province_name' => 'required',
        'archdeaconary_name'=>'required',
        'parish_name' =>'required'
        ]);
        $parish = new Parish();
        $parish->archdeaconary_id = $request->archdeaconary_name;
        $parish->diocese_id = $request->diocese_name;
        $parish->province_id = $request->province_name;
        $parish->date_created = date('Y-m-d');
        $parish->parish_name = $request->parish_name;
        $parish->inserted_by = isset(Auth::user()->id) ? Auth::user()->id : '';
        if($parish->save()){
            return redirect('parish/create')->with('message', 'Data Saved Successfully');
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
