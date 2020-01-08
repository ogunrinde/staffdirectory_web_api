<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parish;
use App\Profile;
use App\Province;
use App\Diocese;
use App\Archdeaconary;
use DB;

class deleteController extends Controller
{
    public function deleteprovince(Request $request){
    	$validatedData = $request->validate([
        'province_id' => 'required',
        ]);
        $delete = Province::findOrFail($request->province_id);
        $delete->delete();
        if($delete){
            return redirect('provinces/create')->with('deletemessage', 'Data Deleted Successfully');
        }
    }
    public function deletediocese(Request $request){
    	$validatedData = $request->validate([
        'diocese_id' => 'required',
        ]);
        $delete = Diocese::findOrFail($request->diocese_id);
        $delete->delete();
        if($delete){
            return redirect('diocese/create')->with('deletemessage', 'Data Deleted Successfully');
        }
    }
    public function deletearchdeaconary(Request $request){
    	$validatedData = $request->validate([
        'archdeaconary_id' => 'required',
        ]);
        $delete = Archdeaconary::findOrFail($request->archdeaconary_id);
        $delete->delete();
        if($delete){
            return redirect('archdeaconary/create')->with('deletemessage', 'Data Deleted Successfully');
        }
    }
    public function deleteparish(Request $request){
    	$validatedData = $request->validate([
        'parish_id' => 'required',
        ]);
        $delete = Parish::findOrFail($request->parish_id);
        $delete->delete();
        if($delete){
            return redirect('parish/create')->with('deletemessage', 'Data Deleted Successfully');
        }
    }
    public function deletepriest(Request $request){
        $validatedData = $request->validate([
        'thispriestid' => 'required',
        ]);
        $delete = Profile::findOrFail($request->thispriestid);
        $delete->delete();
        if($delete){
            return redirect('showpriest')->with('deletemessage', 'Data Deleted Successfully');
        }
    }
    public function showpriest(Request $request){
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
        return view('delete.priest',['provinces'=>$provinces,'dioceses'=>$dioceses,'archdeaconary'=>$archdeaconary,'parishes'=>$parishes,'profile'=>$profile]);
    }
}
