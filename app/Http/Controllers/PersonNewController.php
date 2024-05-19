<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Illuminate\Http\Response;
use \Illuminate\Database\QueryException;
use Exception;


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






        public function indexNewEnrolments()
        {
            $persons = DB::table('NewUsersInformation')
            ->join('SanaMarhala','SanaMarhala.SanaMarhalaID','=','NewUsersInformation.SanaMarhalaID')
            ->get();
            return view("person.new-enrolments-index", array('persons' => $persons));
        }

        public function countNewEnrolmentsMarahel()
        {
            $marahel = array();
            $counts = array();
            for($i=3;$i<22;$i++)
            {
                $counts[$i] = DB::table('NewUsersInformation')->where('SanaMarhalaID',$i)->count();
            } 
            
            return view('person.new-enrolments-marahel-count', array('marahel'=>$marahel,'counts'=>$counts));
        }

        public function countNewEnrolmentsQetaat()
        {

            $counts = array();
            $qetaat = array();
            for($i=1;$i<10;$i++)
            {
                $counts[$i] = DB::table('NewUsersInformation')->where('QetaaID',$i)->count();
                $qetaat[$i] = DB::table('Qetaa')->where('QetaaID',$i)->select('QetaaName')->get();
            }
            
            return view('person.new-enrolments-qetaat-count', array('qetaat'=>$qetaat, 'counts'=>$counts));
        }


        public function showNewEnrolments($id)
        {
            $person = DB::table('NewUsersInformation')->where('PersonID',$id)
            ->leftJoin('BloodType', 'BloodType.BloodTypeID','=','NewUsersInformation.BloodTypeID')
            ->leftJoin('Qetaa', 'Qetaa.QetaaID', '=', 'NewUsersInformation.QetaaID')
            ->leftJoin('SanaMarhala', 'SanaMarhala.SanaMarhalaID', '=', 'NewUsersInformation.SanaMarhalaID')
            ->leftJoin('Manteqa', 'Manteqa.ManteqaID', '=', 'NewUsersInformation.ManteqaID')
            ->leftJoin('Districts', 'Districts.DistrictID', '=', 'NewUsersInformation.DistrictID')
            ->get()->first();
            
            $questions = DB::table('NewUsersPersonEntryQuestions')
            ->join('MarhalaEntryQuestions', 'MarhalaEntryQuestions.QuestionID', '=', 'NewUsersPersonEntryQuestions.QuestionID')
            ->select('MarhalaEntryQuestions.QuestionText','NewUsersPersonEntryQuestions.Answer')
            ->where('NewUsersPersonEntryQuestions.PersonID', $id)->get();

            //return $person->PersonID;
            return view('person.new-enrolments-show', array('person'=>$person, 'questions'=>$questions));
        }

        public function deleteNewEnrolments($id)
        {
            $person = DB::table('NewUsersInformation')->where('PersonID','=',$id)->select('NewUsersInformation.PersonID', 'NewUsersInformation.ShamandoraCode')->first();

            return view("person.new-enrolments-delete", array('person' => $person));
        }

        public function destroyNewEnrolments($id)
        {
            DB::beginTransaction();

            DB::table('NewUsersInformation')->where('PersonID',$id)->delete();
            DB::table('NewUsersPersonEntryQuestions')->where('PersonID', $id)->delete();

            DB::commit();

            return redirect()->route('person.new-enrolments-index');
        }

        public function approveNewEnrolments($id)
        {   
            return redirect()->route('person.new-enrolments-approve-again', $id);
        }

        public function approveAgainNewEnrolments($id)
        {
            $approvedInt = 1;
            DB::table('NewUsersInformation')->where('PersonID', $id)->update(['IsApproved' => $approvedInt]);
            return redirect()->route('person.new-enrolments-index', $id);
        }





        public function createLiveForm()
        {

            $seneen_marahel = DB::table('SanaMarhala')->get();

            return view("person.person-create-liveform-1", array(
                'seneen_marahel'=>$seneen_marahel
            ));
        }

        public function insertLiveForm(Request $request)
        {
            if($request->sana_marhala_id==NULL||$request->gender==NULL)
            {
                $seneen_marahel = DB::table('SanaMarhala')->get();

                return view("person.person-create-liveform-1", array(
                    'seneen_marahel'=>$seneen_marahel
                ));
            }

            if($request->sana_marhala_id<5&&$request->sana_marhala_id>2)
            {
                $qetaa_name = "براعم";
                $qetaa_id = 1;
                $gender = $request->gender;
            }
            elseif($request->sana_marhala_id<9&&$request->sana_marhala_id>4)
            {
                if($request->gender=="Male")
                {
                    $qetaa_name = "أشبال";
                    $qetaa_id = 2;
                    $gender = "Male";
                }
                elseif($request->gender=="Female")
                {
                    $qetaa_name = "زهرات";
                    $qetaa_id = 9;
                    $gender = "Female";
                }
            }
            elseif($request->sana_marhala_id<12&&$request->sana_marhala_id>8)
            {
                if($request->gender=="Male")
                {
                    $qetaa_name = "كشافة";
                    $qetaa_id = 8;
                    $gender = "Male";
                }
                elseif($request->gender=="Female")
                {
                    $qetaa_name = "مرشدات";
                    $qetaa_id = 6;
                    $gender = "Female";
                }
            }
            elseif($request->sana_marhala_id<14&&$request->sana_marhala_id>11)
            {
                if($request->gender=="Male")
                {
                    $qetaa_name = "متقدم";
                    $qetaa_id = 3;
                    $gender = "Male";
                }
                elseif($request->gender=="Female")
                {
                    $qetaa_name = "رائدات";
                    $qetaa_id = 4;
                    $gender = "Female";
                }
            }
            elseif($request->sana_marhala_id<21&&$request->sana_marhala_id>14)
            {
                    $qetaa_name = "جوالة";
                    $qetaa_id = 5;
                    $gender = $request->gender;
            }
            else
            {
                $qetaa_name = "قادة";
                $qetaa_id = 7;
                $gender = $request->gender;
            }

            //return $request->sana_marhala_id;
            $marhala_limit = DB::table('MarhalaLiveFormLimit')
                        ->where('MarhalaLiveFormLimit.QetaaID', $qetaa_id)
                        ->select('MarhalaLiveFormLimit.MaxLimit')
                        ->first()->MaxLimit;
            //return $marhala_limit;

            $numberOfStudentsCurrentlySubmittedInSanaMarhala = 
                        DB::table('NewUsersInformation')
                        ->where('NewUsersInformation.QetaaID', $qetaa_id)
                        ->count();
            //return $numberOfStudentsCurrentlySubmittedInSanaMarhala;

            if($numberOfStudentsCurrentlySubmittedInSanaMarhala>$marhala_limit)
            {      
                return view('person.liveform-limit-exceeded');
            }

            $marahel = DB::table('Marhala')->get();
            $rotab = DB::table('RotbaInformation')->get();
            $sana_marhala_name = DB::table('SanaMarhala')
                                -> where('SanaMarhala.SanaMarhalaID',$request->sana_marhala_id)
                                -> select('SanaMarhalaName')
                                -> first()
                                -> SanaMarhalaName;

            $questionTypes = DB::table('QuestionsTypes')->get();
            $blood = DB::table('BloodType')->get();
            $betakat = DB::table('EgazetBetakatTaqaddom')->get();
            $manateq = DB::table('Manteqa')->get();
            $districts = DB::table('Districts')->get();
            

            return view("person.person-create-liveform", 
            array('marahel'=>$marahel, 
                    'rotab'=>$rotab,
                    'sana_marhala_id'=>$request->sana_marhala_id,
                    'sana_marhala_name'=>$sana_marhala_name,
                    'qetaa_id'=>$qetaa_id,
                    'qetaa_name'=>$qetaa_name,
                    'gender'=>$gender, 
                    'questionTypes'=>$questionTypes, 
                    'blood'=>$blood, 
                    'manateq'=>$manateq, 
                    'districts'=>$districts,
                ));
            //return view('person.person-create-liveform', array('sana_marhala_id' => $request->sana_marhala_id));
            //return redirect()->route('person.de7k', $marhala_limit);
            //return $request->sana_marhala_id;
        }

        public function insertNewPersonLiveForm(Request $request)
        {
            
            $lastPersonID = DB::table('NewUsersInformation')->orderBy('PersonID','desc')->first();
            
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
            
            
              
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $passString =  implode($pass); //turn the array into a string

        $QetaaName = DB::table('Qetaa')->where('Qetaa.QetaaID', $request->qetaa_id)->first()->QetaaName;
        //return $QetaaName;
        try{

            $validatedData = $request->validate([
                'first_name' => 'required',
                'second_name' => 'required',
                'third_name' => 'required',
                'gender'=>'required',
                'email_input'=> 'email',
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
              ]);
            
            DB::table('NewUsersInformation')->insert(
                array(
                    'PersonID'              => $thisPersonID,
                    'ShamandoraCode'        => $shamandoraCode,
                    'FirstName'             => $request->first_name,
                    'SecondName'            => $request->second_name,
                    'ThirdName'             => $request->third_name,
                    'FourthName'            => $request->fourth_name,
                    'Gender'                => $request->gender,
                    'DateOfBirth'           => $request->birthdate_input,
                    'RaqamQawmy'            => $request->input_raqam_qawmy,
                    'ScoutJoiningYear'      => $request->joining_year_input,
                    'BloodTypeID'           => $request->blood_type_input,
                    'FacebookProfileURL'    => $request->inputFacebookLink,
                    'InstagramProfileURL'   => $request->inputInstagramLink,
                    'PersonalEmail'         => $request->email_input,
                    'BuildingNumber'        => $request->building_number,
                    'FloorNumber'           => $request->floor_number,
                    'AppartmentNumber'      => $request->appartment_number,
                    'MainStreetName'        => $request->main_street_name,
                    'SubStreetName'         => $request->sub_street_name,
                    'ManteqaID'             => $request->manteqa_id,
                    'DistrictID'            => is_null($request->district_id)?1:$request->district_id,
                    'NearestLandmark'       => $request->nearest_landmark,
                    'SanaMarhalaID'         => $request->sana_marhala_id, 
                    'SpiritualFatherName'   => $request->spiritual_father,
                    'SpiritualFatherChurchName' => $request->spiritual_father_church,
                    'Password'              => $passString, 
                    'PersonPersonalMobileNumber' => $request->personal_phone_number,
                    'FatherMobileNumber'    => $request->father_phone_number,
                    'MotherMobileNumber'    => $request->mother_phone_number,
                    'HomePhoneNumber'       => $request->home_phone_number,
                    'IsOPersonalPhoneNumberHavingWhatsapp' => $request->has_whatsapp,
                    'SchoolName'            => $request->person_school,
                    'SchoolGraduationYear'  => $request->school_grad_year,
                    'QetaaID'               => $request->qetaa_id,
                    'QetaaName'             => $QetaaName,    
                )
            );

        }
        catch(Exception $e)
        {
            //return view('person.entry-error');
            //dd($e->getMessage());
            DB::rollBack();
            return view('person.entry-error-repeat-trial');
        }

            DB::commit();

            return redirect()->route('person.entry-questions-liveform', $thisPersonID);
        }

        public function getLiveformQuestions ($id)
        {
            $person = DB::table('NewUsersInformation')
                    ->where('NewUsersInformation.PersonID', $id)
                    ->first();
            

            $questions = DB::table('MarhalaEntryQuestions')->where('QetaaID', $person->QetaaID)->get();

            return view('person.person-questions-liveform', array('questions'=>$questions, 'person'=>$person));
        }

        public function submitLiveformQuestions(Request $request)
        {
            //return $request[88];
            //$data = $request->all();
            $person = DB::table('NewUsersInformation')
                    ->where('NewUsersInformation.PersonID', $request->person_id)
                    ->first();
            
            
            $questions = DB::table('MarhalaEntryQuestions')->where('QetaaID', '=' ,$person->QetaaID)->get();
            
            DB::beginTransaction();
        try{
            
            foreach ($questions as $question)
            {  
                
                $q = $request[$question->QuestionID];

                if($question->IsRequired&&$q==NULL)
                {
                    //return $question->QuestionID;
                    //return $question->QuestionID;
                    DB::rollBack();
                    return view('person.entry-error-repeat-trial');
                }
                DB::table('NewUsersPersonEntryQuestions')->insert(
                    array(
                        'PersonID' => $request->person_id,
                        'QuestionID' => $question->QuestionID,
                        'Answer' => $q
                    )
                );
            }
        }
        catch(Exception $e)
        {
            //dd($e->getMessage());
            DB::rollBack();
            return view('person.entry-error');
        }
        DB::commit();
            
        return view('person.liveform-finalize');

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
                'email_input'=> 'email',
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
            
            DB::beginTransaction();
            
        try{
            DB::table('PersonInformation')->insert(
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

            DB::table('PersonJob')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'JobName'=>$request->person_job,
                    'WorkPlace'=>$request->person_job_place
                )
            );

            DB::table('PersonLearningInformation')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'SchoolName'=>$request->person_school,
                    'SchoolGraduationYear'=>$request->school_grad_year,
                    'FacultyID'=>$request->person_faculty,
                    'UniversityID'=>$request->person_university,
                    'ActualFacultyGraduationYear'=>$request->university_grad_year
                )
            );




            //$timestamp = time();
            //$formatted = date('y-m-d h:i:s T', $timestamp);

            DB::table('PersonRotbaKashfeyya')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'RotbaID'=>$request->rotba_kashfeyya_id
                )
            );


            DB::table('PersonQetaa')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'QetaaID'=>$request->qetaa_id
                )
            );


            DB::table('PersonEgazetBetakatTaqaddom')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'EgazetBetakatTaqaddomID'=>$request->betaka_id
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

            //return "".$thisPersonID."\n".$passString;

            DB::table('PersonSystemPassword')->insert(
                array(
                    'PersonID'=>$thisPersonID,
                    'Password'=>$passString 
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
                    'DistrictID'=>is_null($request->district_id)?1:$request->district_id,
                    'NearestLandmark'=>$request->nearest_landmark
                )
            );

        }
        catch(Exception $e)
        {
            dd($e->getMessage());
            DB::rollBack();
            return view('person.entry-error');
        }

            DB::commit();

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
            DB::beginTransaction();
            
            
            $person = DB::table('PersonInformation')
                    ->where('PersonInformation.PersonID', $request->person_id)
                    ->Join('PersonQetaa', 'PersonInformation.PersonID' , '=', 'PersonQetaa.PersonID')
                    ->Join('Qetaa', 'PersonQetaa.QetaaID', '=', 'Qetaa.QetaaID')
                    ->Join('PersonSystemPassword', 'PersonInformation.PersonID' , '=', 'PersonSystemPassword.PersonID')
                    ->select('PersonInformation.*', 'PersonSystemPassword.Password', 'PersonQetaa.QetaaID', 'Qetaa.QetaaName')
                    ->first();
            
            $questions = DB::table('MarhalaEntryQuestions')->where('QetaaID', '=' ,$person->QetaaID)->get();

            
            DB::beginTransaction();
        try{
            
            foreach ($questions as $question)
            {  
                
                $q = $request[$question->QuestionID];
                //return $qs;

                if($question->IsRequired&&$q==NULL)
                {
                    //return $question->QuestionID;
                    DB::rollBack();
                    return view('person.entry-error');
                }
                DB::table('NewUsersPersonEntryQuestions')->insert(
                    array(
                        'PersonID' => $request->person_id,
                        'QuestionID' => $question->QuestionID,
                        'Answer' => $q
                    )
                );
            }
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
            DB::rollBack();
            return view('person.entry-error-repeat-trial');
        }
        DB::commit();
            
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
            DB::beginTransaction();

            DB::table('PersonEgazetBetakatTaqaddom')->where('PersonID',$id)->delete();
            DB::table('PersonJob')->where('PersonID',$id)->delete();
            DB::table('PersonLearningInformation')->where('PersonID',$id)->delete();
            DB::table('PersonPhoneNumbers')->where('PersonID',$id)->delete();
            DB::table('PersonQetaa')->where('PersonID',$id)->delete();
            DB::table('PersonRotbaKashfeyya')->where('PersonID',$id)->delete();
            DB::table('PersonalPhysicalAddress')->where('PersonID',$id)->delete();
            DB::table('PersonSystemPassword')->where('PersonID',$id)->delete();
            DB::table('PersonSanaMarhala')->where('PersonID',$id)->delete();
            DB::table('PersonSpiritualFatherInformation')->where('PersonID',$id)->delete();
            DB::table('PersonInformation')->where('PersonID',$id)->delete();
            DB::table('PersonEntryQuestions')->where('PersonID', $id)->delete();

            DB::commit();

            return redirect()->route('person.index');
        }



}