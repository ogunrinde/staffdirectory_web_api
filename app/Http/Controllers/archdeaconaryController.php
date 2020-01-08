<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Archdeaconary;
use Illuminate\Support\Facades\Auth;
use Session;

class archdeaconaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diocese_id = Session::get('diocese_id');
        $archdeaconaries = DB::table('archdeaconaries')
            ->select('*')
            ->where('diocese_id','=', $diocese_id)
            ->get();
        $parishes = DB::table('parishes')
            ->where('diocese_id','=', $diocese_id)
            ->get(); 
        $profiles = DB::table('profiles')
            ->where('current_diocese','=', $diocese_id)
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
        return view('archdeaconary.index',['rtrev'=>$rtrev,'vyrev'=>$vyrev,'ven'=>$ven, 'revcan'=>$revcan,'evang'=>$evang, 'rev'=>$rev,'archdeaconaries'=>$archdeaconaries,'parishes'=>$parishes,'profiles'=>$profiles]);
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
            //return $provinces;
        return view('archdeaconary.create',['provinces'=>$provinces,'dioceses'=>$dioceses,'archdeaconary'=>$archdeaconary]);
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
        'archdeaconary'=>'required'
        ]);
        $arch = new Archdeaconary();
        $arch->archdeaconary_name = $request->archdeaconary;
        $arch->province_id = $request->province_name;
        $arch->date_created = date('Y-m-d');
        $arch->diocese_id = $request->diocese_name;
        $arch->inserted_by = isset(Auth::user()->id) ? Auth::user()->id : '';
        if($arch->save()){
            return redirect('archdeaconary/create')->with('message', 'Data Saved Successfully');
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
