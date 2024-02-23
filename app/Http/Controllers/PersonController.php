<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Illuminate\Http\Response;

class PersonController extends Controller
{
/**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {
            $persons = DB::table('PersonInformation')->get();
            return view("tables", compact("persons"))->with("Done", "E7na gamdeen");
        }
    
        /**
            * Show the form for creating a new resource.
            *
            * @return Response
            */


        public function validateFirstPart(Request $request) {
            //echo $request->input_raqam_qawmy;

            //echo "OKKK";
            //echo $request->input_raqam_qawmy;

            
            return redirect('/')->with('status','تم ادخال بيانات الجزء الأول بنجاح');
            //creates a proper ID
            //posts in DB
            //then redirects to the second part if OK
            //or redirects to the first part if not Ok (with alerts)
        }


        public function createPersonController()
        {
            $address = DB::table('PersonalPhysicalAddress')->get();
            $blood = DB::table('BloodType')->get();
            $rotab = DB::table('RotbaInformation')->get();
            $persons = DB::table('PersonInformation')->get();

            return view("createperson", array('rotab' => $rotab, 'persons'=> $persons, 'blood' => $blood, 'address' => $address));
        }

        /*public function selectSearch(Request $request)
        {
            $streetNames = [];
            if($request->has('q')){
                $search = $request->q;
                $streetNames =DB::table('PersonalPhysicalAddress')::select("PersonID", "MainStreetName")
                        ->where('MainStreetName', 'LIKE', "%$search%")
                        ->get();
            }
            return response()->json($movies);
        }*/

        public function submitPersonController(Request  $request)
        {
            //echo $request->first_name;
            $validatedData = $request->validate([
                'first_name' => 'required',
                'second_name' => 'required',
                'third_name' => 'required',
                'gender'=>'required',
                'email_input'=> 'required|email',
                'birthdate_input' => 'required',
                'joining_year_input' => 'required',
                'input_raqam_qawmy' => 'required|min_digits:14|max_digits:14',
                'facebookLink'=>'url',
                'instagramLink'=>'url',
                'blood_type_input'=>'required',
                'personal_phone_number'=>'required|min_digits:11|max_digits:11',
                'has_whatsapp'=>'required',
                'building_number'=>'required',
                'floor_number'=>'required',
                'appartment_number' =>'required',
                'sub_street_name' => 'required',
                'manteqa_id'=>'required',
                'district_id'=>'required',
                'sana_marhala_id'=>'required',
              ]);
            
            $lastPersonID = DB::table('PersonInformation')
            ->orderBy('PersonID','desc')->first();
            $thisPersonID = $lastPersonID->PersonID+1;
            DB::table('PersonInformation')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'FirstName' => $request->first_name,
                    'SecondName' => $request->second_name,
                    'ThirdName'   => $request->third_name,
                    'FourthName' => $request->fourth_name,
                    'Gender' => $request->gender,
                    'DateOfBirth' => $request->birthdate_input,
                    'RaqamQawmy' => $request->input_raqam_qawmy,
                    'ScoutJoiningYear'  => $request->joining_year_input,
                    'BloodTypeID' => $request->blood_type_input,
                    'FacebookProfileURL' =>$request->facebookLink,
                    'InstagramProfileURL' =>$request->instagramLink ,
                    'PersonalEmail' => $request->email_input,
                    'MotherFirstName' => "",
                    'MotherSecondName' => "",
                )
            );

            DB::table('PersonPhoneNumbers')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'PersonPersonalMobileNumber' => $request->personal_phone_number,
                    'FatherMobileNumber' => $request->father_phone_number,
                    'MotherMobileNumber'   => $request->mother_phone_number,
                    'HomePhoneNumber' => $request->home_phone_number,
                    'IsOPersonalPhoneNumberHavingWhatsapp' => $request->has_whatsapp,
                )
            );

            return redirect('createperson')->with('status',' :تم ادخال البيانات بنجاح للملتحق رقم' .$thisPersonID);
        }
    
        /**
            * Store a newly created resource in storage.
            *
            * @return Response
            */
        public function store()
        {
            //
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
            //
        }
    
        /**
            * Update the specified resource in storage.
            *
            * @param  int  $id
            * @return Response
            */
        public function update($id)
        {
            //
        }
    
        /**
            * Remove the specified resource from storage.
            *
            * @param  int  $id
            * @return Response
            */
        public function destroy($id)
        {
            //
        }
}