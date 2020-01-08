<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class viewController extends Controller
{
    public function index($id,$role) {
    	$id = base64_decode($id);
    	$role = $role;
    	if($role == 'bishop'){
    		$prof = DB::table('profiles')
            ->select('*')
            ->where(['current_diocese'=>$id])
            ->get();
    	}else{
            $prof = DB::table('profiles')
            ->select('*')
            ->where(['current_diocese'=>$id])
            ->get();
        }
    	foreach($prof as $p){
    		if(strtolower($p->position) == strtolower($role)){
    			$profiles[] = $p;
    		}
    	}
        //return $profiles;
        return  view('view.index',['profile'=>$profiles]);
    }
    public function priest($profile_id,$id,$role) {
        $id = base64_decode($id);
        $profile_id = base64_decode($profile_id);
        $role = $role;
        if($role == 'bishop'){
            $prof = DB::table('profiles')
            ->select('*')
            ->where(['current_diocese'=>$id])
            ->get();
        }else{
            $prof = DB::table('profiles')
            ->select('*')
            ->where(['current_diocese'=>$id])
            ->get();
        }
        foreach($prof as $p){
            if(strtolower($p->position) == strtolower($role) && $p->id == $profile_id){
                $profiles[] = $p;
                //$profiles[]['img'] = imagerotate($p->image, -90, 0);
            }
        }
        //return $profiles;
        return  view('view.index',['profile'=>$profiles]);
    }
}
