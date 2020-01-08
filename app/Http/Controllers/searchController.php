<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class searchController extends Controller
{
    public function searchpriest(Request $request){
    	$validatedData = $request->validate([
          'search' => 'required',
        ]);
        $provinces = DB::table('provinces')
            ->select('*')
            ->get();
        Session::put('searchparam', $request->search);
        return Redirect::route('home');            
        //return view('home.index',['provinces'=>$provinces,'users'=>$users]);          
    }
}
