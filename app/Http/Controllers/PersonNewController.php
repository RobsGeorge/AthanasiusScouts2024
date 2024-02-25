<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Illuminate\Http\Response;

class PersonNewController extends Controller
{


/**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {
            $persons = DB::table('PersonInformation')
            ->leftJoin('PersonPhoneNumbers', 'PersonInformation.PersonID', '=', 'PersonPhoneNumbers.PersonID')
            ->select('PersonInformation.*', 'PersonPhoneNumbers.PersonPersonalMobileNumber')
            ->get();
            return view("person.person-index", array('persons' => $persons));
        }

        public function create()
        {
            $marahel = DB::table('Marhala')->get();
            $rotab = DB::table('RotbaInformation')->get();
            $seneen_marahel = DB::table('SanaMarhala')->get();
            $questionTypes = DB::table('QuestionsTypes')->get();
            $blood = DB::table('BloodType')->get();
            $betakat = DB::table('EgazetBetakatTaqaddom')->get();
            $manateq = DB::table('Manteqa')->get();
            $districts = DB::table('Districts')->get(); 
            return view("person.person-create", array('marahel'=>$marahel, 'rotab'=>$rotab, 'seneen_marahel'=>$seneen_marahel, 'questionTypes'=>$questionTypes, 'blood'=>$blood, 'betakat'=>$betakat, 'manateq'=>$manateq, 'districts'=>$districts));
        }

        public function insert(Request  $request)
        {
            $lastPersonID = DB::table('PersonInformation')->orderBy('PersonID','desc')->first();
            
            if($lastPersonID==Null)
                $thisPersonID = 1;
            else
                $thisPersonID = $lastPersonID->PersonID + 1;

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

            $timestamp = time();
            $formatted = date('y-m-d h:i:s T', $timestamp);

            DB::table('PersonRotbaKashfeyya')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'RotbaID=>'=>$request->rotba_kashfeyya_id,
                    'UpdateTimestamp'=>$formatted
                )
            );

            DB::table('PersonEgazetBetakatTaqaddom')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'EgazetBetakatTaqaddomID'=>$request->betaka_id,
                    'UpdateTimestamp'=>$formatted
                )
            );

            DB::table('PersonSanaMarhala')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'SanaMarhalaID'=>$request->sana_marhala_id
                )
            );

            DB::table('PersonSpiritualFatherInformation')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'SpiritualFatherName'=>$request->spiritual_father,
                    'SpiritualFatherChurchName'=>$request->spiritual_father_church
                )
            );

                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $pass = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                }
                $passString =  implode($pass); //turn the array into a string

            DB::table('PersonSystemPassword')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'Password'=>$passString,
                    'PasswordCreationTimestamp'=>$formatted
                )
            );

            DB::table('PersonalPhysicalAddress')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'BuildingNumber'=>$request->building_number,
                    'FloorNumber'=>$request->floor_number,
                    'AppartmentNumber'=>$request->appartment_number,
                    'MainStreetName'=>$request->main_street_name,
                    'SubStreetName'=>$request->sub_street_name,
                    'ManteqaID'=>$request->manteqa_id,
                    'DistrictID'=>$request->district_id,
                    'NearestLandmark'=>$request->nearest_landmark
                )
            );

            return redirect('person.index');
        }
    
        /**
            * Display the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function show($id)
        {
            $person = DB::table('PersonInformation')->where('PersonID', $id)->first();
            return view("person.person-show", array('person'=>$person));
        }
    
        /**
            * Show the form for editing the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function edit($id)
        {
            $questionTypes = DB::table('QuestionsTypes')->get();
            $marahel = DB::table('Marhala')->get();
            $entryQuestions = DB::table('MarhalaEntryQuestions')->where('QuestionID', $id)->first();
            //print_r($rotab->RotbaID);
            return view("person.person-edit", array('entryQuestions' => $entryQuestions, 'marahel'=>$marahel, 'questionTypes'=>$questionTypes,'title'=> "تعديل بيانات شخص"));
        }
    
        public function updates(Request $request, $id)
        {
            $entryQuestions = DB::table('MarhalaEntryQuestions')->where('QuestionID', $id)->first();

            $affected = DB::table('MarhalaEntryQuestions')->where('QuestionID', $id)->update(['QuestionText' => $request->question_text, 'RequiredAnswerType'=> $request->required_answer_type]);
            
            return redirect()->route('person.index')->with('status','تم تعديل بنجاح البيانات');
        }
    
        public function deletes($id)
        {
            $marahel = DB::table('Marhala')->get();
            $entryQuestions = DB::table('MarhalaEntryQuestions')->where('QuestionID', $id)->first();
            return view("person.person-delete", array('marahel' => $marahel, 'entryQuestions' => $entryQuestions, 'title'=> "حذف شخص "));
        }

        public function destroy($id)
        {
            $deleted = DB::table('MarhalaEntryQuestions')->where('QuestionID',$id)->delete();

            return redirect()->route('person.index')->with('status','تم الغاء الشخص بنجاح');
        }

}