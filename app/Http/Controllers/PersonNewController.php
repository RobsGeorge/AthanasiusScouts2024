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
            $persons = DB::table('PersonInformation')->get();
            $persons = DB::table('PersonInformation')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
            $personsToList = DB::query();
            return view("person-index", array('persons' => $persons));
        }

        public function create()
        {
            $marahel = DB::table('Marhala')->get();
            $questionTypes = DB::table('QuestionsTypes')->get();
            return view("person-create", array('marahel'=>$marahel, 'questionTypes' => $questionTypes));
        }

        public function insert(Request  $request)
        {
            $lastQuestionID = DB::table('MarhalaEntryQuestions')->orderBy('QuestionID','desc')->first();
            
            if($lastQuestionID==Null)
                $thisQuestionID = 1;
            else
                $thisQuestionID = $lastQuestionID->QuestionID + 1;

            DB::table('MarhalaEntryQuestions')->insert(
                array(
                    'QuestionID' => $thisQuestionID,
                    'MarhalaID' => $request -> marhala_id,
                    'QuestionText' => $request -> question_text,
                    'RequiredAnswerType' => $request -> required_answer_type
                )
            );
            return redirect()->route('person.index')->with('status',' :تم ادخال بنجاح الشخص' .$thisQuestionID);
        }
    
        /**
            * Display the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function show($id)
        {
            $marahel = DB::table('Marhala')->get();
            $questionTypes = DB::table('QuestionsTypes')->get();
            return view("person-show", array('marahel'=>$marahel, 'questionTypes' => $questionTypes));
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
            return view("person-edit", array('entryQuestions' => $entryQuestions, 'marahel'=>$marahel, 'questionTypes'=>$questionTypes,'title'=> "تعديل بيانات شخص"));
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
            return view("person-delete", array('marahel' => $marahel, 'entryQuestions' => $entryQuestions, 'title'=> "حذف شخص "));
        }

        public function destroy($id)
        {
            $deleted = DB::table('MarhalaEntryQuestions')->where('QuestionID',$id)->delete();

            return redirect()->route('person.index')->with('status','تم الغاء الشخص بنجاح');
        }

}