<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class churchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diocese_id = Session::get('diocese_id');
        $parishes = DB::table('parishes')
            ->leftjoin('archdeaconaries','archdeaconaries.id','=','parishes.archdeaconary_id')
            ->select('archdeaconaries.archdeaconary_name','parishes.parish_name','parishes.id','parishes.diocese_id')
            ->where('parishes.diocese_id','=', $diocese_id)
            ->get();
        $profiles = DB::table('profiles')
            ->select('*')
            ->where('current_diocese','=', $diocese_id)
            ->get();      

         $dean = [];
         $vicar = [];   
         $curate = [];
         $chaplincurate = [];
         $chaplin = [];
        foreach ($profiles as $k) {
          if( strtolower($k->position) == 'dean' ){
             $dean[] = $k;
          } 
          else if( strtolower($k->position) == 'vicar' ){
             $vicar[] = $k;
          } 
          else if( strtolower($k->position) == 'curate' ){
             $curate[] = $k;
          }
          else if( strtolower($k->position) == 'chaplin/curate' ){
             $chaplincurate[] = $k;
          }
          else if( strtolower($k->position) == 'chaplin' ){
             $chaplin[] = $k;
          }       
        }  
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
            //return $parishes;
        return view('church.index',['parishes'=>$parishes,'profiles'=>$profiles,'dean'=>$dean,'vicar'=>$vicar,'curate'=>$curate,'chaplincurate'=>$chaplincurate,'chaplin'=>$chaplin,'rtrev'=>$rtrev,'vyrev'=>$vyrev,'ven'=>$ven, 'revcan'=>$revcan,'evang'=>$evang, 'rev'=>$rev,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
