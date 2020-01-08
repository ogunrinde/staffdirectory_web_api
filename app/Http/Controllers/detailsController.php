<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class detailsController extends Controller
{
    public function province($id){
    	$province_id = base64_decode($id);
    	if(!isset($province_id)) return view('profile.index');
    	$dioceses = DB::table('dioceses')
    	    ->join('provinces','provinces.id','=','dioceses.province_id')
            ->select('provinces.province_name','dioceses.diocese_name','dioceses.id')
            ->where('province_id','=',$province_id)
            ->get();
        $provinces = DB::table('provinces')
            ->select('*')
            ->get();       
    	return $dioceses;
    	return view('diocese.index',['dioceses'=>$dioceses,'provinces'=>$provinces]);
    }
    public function diocese($id){
        $t = [];
        $diocese_id = base64_decode($id);
        if(!isset($diocese_id)) return view('home.index');
         $dioceses = DB::table('dioceses')
            ->select('*')
            ->where('id','=',$diocese_id)
            ->get(); 
        Session::put('diocese_id', $diocese_id);
         $profile = DB::table('profiles')
            ->select('*')
            ->where(['current_diocese'=> $diocese_id])
            ->get();  
        //return $profile;    
        foreach($profile as $p){
            if(strtolower($p->position) == 'bishop'){
                $t[] = $p;
            }
        } 
        //return $t;
        return view('diocese.index',['dioceses'=>$dioceses,'profiles'=>$t]);
    }
    public function archdeaconary($id){
    	$diocese_id = base64_decode($id);
        session()->put('diocese_id', $diocese_id);
    	if(!isset($diocese_id)) return view('profile.index');
    	$archdeaconary = DB::table('archdeaconaries')
    	    ->join('dioceses','dioceses.id','=','archdeaconaries.diocese_id')
    	    ->join('provinces','provinces.id','=','archdeaconaries.province_id')
            ->select('provinces.province_name','dioceses.province_id','dioceses.diocese_name','archdeaconaries.archdeaconary_name','archdeaconaries.id')
            ->where('archdeaconaries.diocese_id','=',$diocese_id)
            ->get();
        $provinces = DB::table('provinces')
            ->select('*')
            ->get();  
            //return $archdeaconary;     
    	//return isset($archdeaconary[0]->province_id) ? $archdeaconary[0]->province_id : '';
        if(isset($archdeaconary[0]->province_id)){
            return view('archdeaconary.index',['archdeaconary'=>$archdeaconary,'provinces'=>$provinces, 'province_id'=>isset($archdeaconary[0]->province_id) ? $archdeaconary[0]->province_id : '']);
        }else {

        }    
    	
    }
    public function parish($id){
    	$arch_id = base64_decode($id);
        session()->put('archdeaconary_id', $arch_id);
    	if(!isset($arch_id)) return view('profile.index');
    	$parish = DB::table('parishes')
    	    ->join('dioceses','dioceses.id','=','parishes.diocese_id')
    	    ->join('provinces','provinces.id','=','parishes.province_id')
    	    ->join('archdeaconaries','archdeaconaries.id','=','parishes.archdeaconary_id')
            ->select('provinces.province_name','dioceses.diocese_name','archdeaconaries.archdeaconary_name','parishes.id','parishes.parish_name','parishes.diocese_id')
            ->where('parishes.archdeaconary_id','=',$arch_id)
            ->get();
        $provinces = DB::table('provinces')
            ->select('*')
            ->get();       
        $diocese_id = Session('diocese_id');
    	//return $parish;
    	return view('parish.index',['provinces'=>$provinces,'parishes'=>$parish, 'diocese_id'=>$diocese_id]);
    }
    public function priest($id){
    	$priest_id = base64_decode($id);
        $education = [];
        $parishes  = [];
        $perferment = [];
    	if(!isset($priest_id)) return view('profile.index');
    	$priest = DB::table('profiles')
    	    ->join('dioceses','dioceses.id','=','profiles.current_diocese')
    	    ->join('provinces','provinces.id','=','profiles.current_province')
    	    ->join('archdeaconaries','archdeaconaries.id','=','profiles.current_archdeaconary')
            ->join('parishes','parishes.id','=','profiles.current_parish')
            ->select('*')
            ->where('profiles.current_parish','=',$priest_id)
            ->get();
        $provinces = DB::table('provinces')
            ->select('*')
            ->get();     
        $archdeaconary_id = Session('archdeaconary_id');  
        if(count($priest) > 0){
            if($priest[0]->all_education != '')
              $education = explode('%%',$priest[0]->all_education);
            if($priest[0]->all_parish != '')
              $parishes =  explode('%%',$priest[0]->all_parish);
            if($priest[0]->all_perferment != '')
               $perferment =  explode('%%',$priest[0]->all_perferment); 
        }
    	//return $priest;
    	return view('profile.index',['provinces'=>$provinces,'priest'=>$priest[0], 'archdeaconary_id'=>$archdeaconary_id, 'education' => $education, 'parishes' => $parishes, 'perferment' =>$perferment]);
    }
}
