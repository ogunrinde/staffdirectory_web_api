<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Diocese;
use Illuminate\Support\Facades\Auth;
use Session;

class dioceseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diocese_id = Session::get('diocese_id');
        $dioceses = DB::table('dioceses')
            ->select('*')
            ->where('id','=', $diocese_id)
            ->get();  
        return view('diocese.index',['dioceses'=>$dioceses]);
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
            //return $provinces;
        return view('diocese.create',['provinces'=>$provinces,'dioceses'=>$dioceses]);
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
        'province_name' => 'required'
        ]);
        $diocese = new Diocese();
        $diocese->province_id = $request->province_name;
        $diocese->date_created = date('Y-m-d');
        $diocese->diocese_name = $request->diocese_name;
        $diocese->inserted_by = isset(Auth::user()->id) ? Auth::user()->id : '';
        if($diocese->save()){
            return redirect('diocese/create')->with('message', 'Data Saved Successfully');
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
