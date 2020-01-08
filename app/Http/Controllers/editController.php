<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\diocean_officials;
use DB;

class editController extends Controller
{
    public function editprovince(Request $request){
        //return $request->province_name;
    	$validatedData = $request->validate([
        'province_id' => 'required',
        ]);
        $edit = DB::table('provinces')
        		->where('id',$request->province_id)
        		->update(['province_name'=> $request->province_name]);
        if($edit){
            return redirect('provinces/create')->with('editmessage', 'Data Edited Successfully');
        }
    }
    public function editofficial(){
        $provinces = DB::table('provinces')
            ->select('*')
            ->get();
        $dioceses = DB::table('dioceses')
            ->select('*')
            ->get();
        $officials = DB::table('diocean_officials')
            ->select('*')
            ->get();    
        return view('edit.officials',['provinces'=>$provinces,'dioceses'=> $dioceses,'officials'=>$officials]);
    }
    public function addofficial(){
        $provinces = DB::table('provinces')
            ->select('*')
            ->get();
        $dioceses = DB::table('dioceses')
            ->select('*')
            ->get(); 
        return view('edit.addofficials',['provinces'=>$provinces,'dioceses'=> $dioceses]);
    }
    public function editdiocese(Request $request){
        $validatedData = $request->validate([
        'diocese_id' => 'required',
        ]);
        $edit = DB::table('dioceses')
                ->where('id',$request->diocese_id)
                ->update(['diocese_name'=> $request->diocese_name]);
        if($edit){
            return redirect('diocese/create')->with('editmessage', 'Data Edited Successfully');
        }
    }
    public function editarchdeaconary(Request $request){
        $validatedData = $request->validate([
        'archdeaconary_id' => 'required',
        ]);
        $edit = DB::table('archdeaconaries')
                ->where('id',$request->archdeaconary_id)
                ->update(['archdeaconary_name'=> $request->archdeaconary_name]);
        if($edit){
            return redirect('archdeaconary/create')->with('editmessage', 'Data Edited Successfully');
        }
    }
    public function moveparish(Request $request){
        //return $request->archdeaconary_id;
        $validatedData = $request->validate([
        'archdeaconary_id' => 'required',
        'parish_id' => 'required'
        ]);
        $edit = DB::table('parishes')
                ->where('id',$request->parish_id)
                ->update(['archdeaconary_id'=> $request->archdeaconary_id]);
        if($edit){
            return redirect('parish/create')->with('movemessage', 'Data Moved Successfully');
        }
    }
    public function editparish(Request $request){
        $validatedData = $request->validate([
        'parish_id' => 'required',
        ]);
        $edit = DB::table('parishes')
                ->where('id',$request->parish_id)
                ->update(['parish_name'=> $request->parish_name]);
        if($edit){
            return redirect('parish/create')->with('editmessage', 'Data Edited Successfully');
        }
    }
    public function editpriest(){
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
        return view('edit.priest',['provinces'=>$provinces,'dioceses'=>$dioceses,'archdeaconary'=>$archdeaconary,'parishes'=>$parishes,'profile'=>$profile]);
    }
    public function savedaddofficialdata(Request $request){
       $validatedData = $request->validate([
        'position' => 'required',
        'email'=>'required',
        'official_name'=>'required',
        'phone'=>'required',
        'address'=>'required',
        'province'=>'required',
        'diocese'=>'required'
        ]);
       $official = new diocean_officials();
       $official->position = $request->position;
       $official->email = $request->email;
       $official->phone_number = $request->phone;
       $official->address = $request->address;
       $official->province_id = $request->province;
       $official->diocese_id = $request->diocese;
       $official->official_name = $request->official_name;
       if($official->save()){
          return redirect('addofficial')->with('message', 'Data Edited Successfully');
       }      
    }
    public function savedofficialdata(Request $request){
       $validatedData = $request->validate([
        'official_id' => 'required',
        ]);
       $edit = DB::table('diocean_officials')
                ->where('id',$request->official_id)
                ->update(['position'=> $request->position,'official_name'=>$request->official_name,'address'=>$request->address, 'email'=>$request->email,'phone_number'=>$request->phone]);
        if($edit){
            return redirect('editofficial')->with('editmessage', 'Data Edited Successfully');
        }        
    }
    public function savedpriestdata(Request $request){
       $validatedData = $request->validate([
        'editid' => 'required',
        ]);
       $saveimage = $request->savedimage;
       if($request->hasFile('image')){
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $ext = $image->getClientOriginalExtension();
            $time = rand(100000000000, 99999999999999).'_'.time().'.'.$ext;
            $image->move(public_path().'/profile/',$time);
            $saveimage = $time;
        }
       //return $request->editid;
       $edit = DB::table('profiles')
                ->where('id',$request->editid)
                ->update(['status'=> $request->status,'firstname'=>$request->firstname, 'surname'=>$request->surname, 'middlename' =>$request->middlename, 'email_a'=>$request->email_a, 'email_b'=>$request->email_b, 'address'=>$request->address,'marital_status'=>$request->marital_status,'date_deaconed'=>$request->date_deaconed,'date_priested'=>$request->date_priested,'phone_number_a'=>$request->phone_number_a,'phone_number_b'=>$request->phone_number_b,'spouse_name'=>$request->spouse_name,'date_married'=>$request->date_married,'spouse_qualification'=>$request->spouse_qualification,'all_education'=>$request->all_education,'all_parish'=>$request->all_parish,'all_perferment'=>$request->all_perferment,'current_province'=>$request->province_name,'current_diocese'=>$request->diocese_name,'current_archdeaconary'=>$request->archdeaconary_name,'current_parish'=>$request->parish_name,'image'=>$saveimage,'dob'=>$request->dob, 'position'=>$request->position]);
        if($edit){
            return redirect('editpriest')->with('editmessage', 'Data Edited Successfully');
        }        
    }
}

