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
            $qetaat = DB::table('Qetaa')->get();
            $faculties = DB::table('Faculty')->get();
            $universities = DB::table('University')->get();
            return view("person.person-create", 
            array('marahel'=>$marahel, 
                    'rotab'=>$rotab, 
                    'seneen_marahel'=>$seneen_marahel, 
                    'questionTypes'=>$questionTypes, 
                    'blood'=>$blood, 
                    'betakat'=>$betakat, 
                    'manateq'=>$manateq, 
                    'districts'=>$districts, 
                    'qetaat'=>$qetaat,
                    'faculties'=>$faculties,
                    'universities'=>$universities,
                ));
        }

        public function insert(Request  $request)
        {
            $lastPersonID = DB::table('PersonInformation')->orderBy('PersonID','desc')->first();
            
            if($lastPersonID==Null)
                $thisPersonID = 1;
            else
                $thisPersonID = $lastPersonID->PersonID + 1;
            
            $shamandoraCode="SH-";

            $shamandoraCodeNumberOfDigits = 5;

            for ($i=0;$i<$shamandoraCodeNumberOfDigits-strlen((string)$thisPersonID);$i++)
            {
                $shamandoraCode = $shamandoraCode.'0';
            }

            $shamandoraCode = $shamandoraCode. $thisPersonID;

            //print_r($shamandoraCode);
            //return "".$thisPersonID."\n".$shamandoraCode;

            
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
              
            

            $x = DB::table('PersonInformation')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'ShamandoraCode'=>$shamandoraCode,
                    'FirstName' => $request->first_name,
                    'SecondName' => $request->second_name,
                    'ThirdName'   => $request->third_name,
                    'FourthName' => $request->fourth_name,
                    'Gender' => $request->gender,
                    'DateOfBirth' => $request->birthdate_input,
                    'RaqamQawmy' => $request->input_raqam_qawmy,
                    'ScoutJoiningYear'  => $request->joining_year_input,
                    'BloodTypeID' => $request->blood_type_input,
                    'FacebookProfileURL' =>$request->inputFacebookLink,
                    'InstagramProfileURL' =>$request->inputInstagramLink,
                    'PersonalEmail' => $request->email_input
                )
            );


            $x = DB::table('PersonPhoneNumbers')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'PersonPersonalMobileNumber' => $request->personal_phone_number,
                    'FatherMobileNumber' => $request->father_phone_number,
                    'MotherMobileNumber'   => $request->mother_phone_number,
                    'HomePhoneNumber' => $request->home_phone_number,
                    'IsOPersonalPhoneNumberHavingWhatsapp' => $request->has_whatsapp,
                )
            );

            $x = DB::table('PersonJob')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'JobName'=>$request->person_job,
                    'WorkPlace'=>$request->person_job_place
                )
            );

            $x = DB::table('PersonLearningInformation')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'SchoolName'=>$request->person_school,
                    'SchoolGraduationYear'=>$request->school_grad_year,
                    'FacultyID'=>$request->person_faculty,
                    'UniversityID'=>$request->person_university,
                    'ActualFacultyGraduationYear'=>$request->university_grad_year
                )
            );




            $timestamp = time();
            $formatted = date('y-m-d h:i:s T', $timestamp);

            $x = DB::table('PersonRotbaKashfeyya')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'RotbaID'=>$request->rotba_kashfeyya_id
                )
            );


            $x = DB::table('PersonQetaa')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'QetaaID'=>$request->qetaa_id
                )
            );


            $x = DB::table('PersonEgazetBetakatTaqaddom')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'EgazetBetakatTaqaddomID'=>$request->betaka_id
                )
            );

            $x = DB::table('PersonSanaMarhala')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'SanaMarhalaID'=>$request->sana_marhala_id
                )
            );

            $x = DB::table('PersonSpiritualFatherInformation')->insert(
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

            //return "".$thisPersonID."\n".$passString;

            $x = DB::table('PersonSystemPassword')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'Password'=>$passString 
                )
            );

            $x = DB::table('PersonalPhysicalAddress')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'BuildingNumber'=>$request->building_number,
                    'FloorNumber'=>$request->floor_number,
                    'AppartmentNumber'=>$request->appartment_number,
                    'MainStreetName'=>$request->main_street_name,
                    'SubStreetName'=>$request->sub_street_name,
                    'ManteqaID'=>$request->manteqa_id,
                    'DistrictID'=>is_null($request->district_id)?1:$request->district_id,
                    'NearestLandmark'=>$request->nearest_landmark
                )
            );

            return redirect()->route('person.entry-questions', $thisPersonID);

        }

        public function getQuestions ($id)
        {
            $person = DB::table('PersonInformation')
                    ->where('PersonInformation.PersonID', $id)
                    ->Join('PersonQetaa', 'PersonInformation.PersonID' , '=', 'PersonQetaa.PersonID')
                    ->Join('Qetaa', 'PersonQetaa.QetaaID', '=', 'Qetaa.QetaaID')
                    ->Join('PersonSystemPassword', 'PersonInformation.PersonID' , '=', 'PersonSystemPassword.PersonID')
                    ->select('PersonInformation.*', 'PersonSystemPassword.Password', 'PersonQetaa.QetaaID', 'Qetaa.QetaaName')
                    ->first();

            $questions = DB::table('MarhalaEntryQuestions')->where('QetaaID', $person->QetaaID)->get();

            return view('person.person-questions', array('questions'=>$questions, 'person'=>$person));
        }

        public function submitQuestions(Request $request)
        {
            
            $person = DB::table('PersonInformation')
                    ->where('PersonInformation.PersonID', $request->person_id)
                    ->Join('PersonQetaa', 'PersonInformation.PersonID' , '=', 'PersonQetaa.PersonID')
                    ->Join('Qetaa', 'PersonQetaa.QetaaID', '=', 'Qetaa.QetaaID')
                    ->Join('PersonSystemPassword', 'PersonInformation.PersonID' , '=', 'PersonSystemPassword.PersonID')
                    ->select('PersonInformation.*', 'PersonSystemPassword.Password', 'PersonQetaa.QetaaID', 'Qetaa.QetaaName')
                    ->first();
            
            $questions = DB::table('MarhalaEntryQuestions')->where('QetaaID', '=' ,$person->QetaaID)->get();

            
            foreach ($questions as $question)
            {  
                $q = $question->QuestionID.'';
                DB::table('PersonEntryQuestions')->insert(
                    array(
                        'PersonID' => $request->person_id,
                        'QuestionID' => $question->QuestionID,
                        'Answer' => $q
                    )
                );
            }
            
            return redirect()->route('person.index');

        }
    
        /**
            * Display the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function show($id)
        {
            $person = DB::table('PersonInformation')
            ->leftJoin('BloodType', 'BloodType.BloodTypeID', '=', 'PersonInformation.BloodTypeID')
            ->leftJoin('PersonEgazetBetakatTaqaddom', 'PersonEgazetBetakatTaqaddom.PersonID' , '=', 'PersonInformation.PersonID')
            ->leftJoin('EgazetBetakatTaqaddom', 'PersonEgazetBetakatTaqaddom.EgazetBetakatTaqaddomID', '=', 'EgazetBetakatTaqaddom.EgazetBetakatTaqaddomID')
            ->leftJoin('PersonJob', 'PersonInformation.PersonID', '=', 'PersonJob.PersonID')
            ->leftJoin('PersonLearningInformation', 'PersonLearningInformation.PersonID', '=', 'PersonInformation.PersonID')
            ->leftJoin('Faculty', 'PersonLearningInformation.FacultyID', '=', 'Faculty.FacultyID')
            ->leftJoin('University', 'PersonLearningInformation.UniversityID', '=', 'University.UniversityID')
            ->leftJoin('PersonPhoneNumbers', 'PersonPhoneNumbers.PersonID', '=', 'PersonInformation.PersonID')
            ->leftJoin('PersonQetaa', 'PersonQetaa.PersonID', '=', 'PersonInformation.PersonID')
            ->leftJoin('Qetaa', 'Qetaa.QetaaID', '=', 'PersonQetaa.QetaaID')
            ->leftJoin('PersonRotbaKashfeyya', 'PersonRotbaKashfeyya.PersonID', '=', 'PersonInformation.PersonID')
            ->leftJoin('RotbaInformation', 'PersonRotbaKashfeyya.RotbaID', '=', 'RotbaInformation.RotbaID')
            ->leftJoin('PersonSanaMarhala', 'PersonSanaMarhala.PersonID', '=', 'PersonInformation.PersonID')
            ->leftJoin('SanaMarhala', 'SanaMarhala.SanaMarhalaID', '=', 'PersonSanaMarhala.SanaMarhalaID')
            ->leftJoin('PersonSpiritualFatherInformation', 'PersonSpiritualFatherInformation.PersonID', '=', 'PersonInformation.PersonID')
            ->leftJoin('PersonSystemPassword', 'PersonInformation.PersonID', '=', 'PersonSystemPassword.PersonID')
            ->leftJoin('PersonalPhysicalAddress', 'PersonalPhysicalAddress.PersonID', '=', 'PersonInformation.PersonID')
            ->leftJoin('Manteqa', 'Manteqa.ManteqaID', '=', 'PersonalPhysicalAddress.ManteqaID')
            ->leftJoin('Districts', 'Districts.DistrictID', '=', 'PersonalPhysicalAddress.DistrictID')
            ->where('PersonInformation.PersonID', $id)->get()->first();
            
            $questions = DB::table('PersonEntryQuestions')
                    ->join('MarhalaEntryQuestions', 'MarhalaEntryQuestions.QuestionID', '=', 'PersonEntryQuestions.QuestionID')
                    ->select('MarhalaEntryQuestions.QuestionText','PersonEntryQuestions.Answer')
                    ->where('PersonEntryQuestions.PersonID', $id)->get();
            
            //return $person;
            return view('person.person-show', array('person'=>$person, 'questions'=>$questions));
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
            $person = DB::table('PersonInformation')->where('PersonID','=',$id)->select('PersonInformation.PersonID', 'PersonInformation.ShamandoraCode')->first();

            return view("person.person-delete", array('person' => $person));
        }

        public function destroy($id)
        {
            
            $deleted = DB::table('PersonEgazetBetakatTaqaddom')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonJob')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonLearningInformation')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonPhoneNumbers')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonQetaa')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonRotbaKashfeyya')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonalPhysicalAddress')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonSystemPassword')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonSanaMarhala')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonSpiritualFatherInformation')->where('PersonID',$id)->delete();
            $deleted = DB::table('PersonInformation')->where('PersonID',$id)->delete();
            
            return redirect()->route('person.index');
        }

}