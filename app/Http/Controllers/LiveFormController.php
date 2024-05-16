<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Illuminate\Http\Response;
use Session;

class LiveFormController extends Controller
{
/**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {
            $sana_marhala = DB::table('MarhalaLiveFormLimit')->get();
            return view("max-limit.index", array('sana_marhala' => $sana_marhala));
        }

        public function create()
        {
            return view("max-limit.create");
        }

        public function insert(Request  $request)
        {
            $lastMaxLimitID = DB::table('MarhalaLiveFormLimit')->orderBy('SanaMarhalaID','desc')->first();
            
            if($lastMaxLimitID==Null)
                $thisMaxLimitID = 1;
            else
                $thisMaxLimitID = $lastMaxLimitID->SanaMarhalaID + 1;            

            DB::table('MarhalaLiveFormLimit')->insert(
                array(
                    'MarhalaLiveFormLimitID' => $thisBloodID,
                    'BloodTypeName' => $request -> blood_name
                )
            );
            return redirect()->route('blood.index')->with('status',' :تم ادخال بنجاح الفصيلة' .$request->blood_name);
        }
    
        /**
            * Display the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function show($id)
        {
            //
        }
    
        /**
            * Show the form for editing the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function edit($id)
        {
            $blood = DB::table('BloodType')->where('BloodTypeID', $id)->first();
            return view("blood.blood-edit", array('blood' => $blood, 'title'=> "تعديل فصيلة دم"));
        }
    
        public function updates(Request $request, $id)
        {
            $blood = DB::table('BloodType')->where('BloodTypeID', $id)->first();

            $affected = DB::table('BloodType')->where('BloodTypeID', $id)->update(['BloodTypeName' => $request->blood_name]);

            return redirect()->route('blood.index')->with('status',' :تم تعديل بنجاح الفصيلة' .$request->blood_name);
        }
    
        public function deletes($id)
        {
            $blood = DB::table('BloodType')->where('BloodTypeID', $id)->first();
            return view("blood.blood-delete", array('blood' => $blood, 'title'=> "حذف فصيلة دم"));
        }

        public function destroy($id)
        {
            $deleted = DB::table('BloodType')->where('BloodTypeID',$id)->delete();
            
            return redirect()->route('blood.index')->with('status','تم الغاء الفصيلة بنجاح');
        }
}