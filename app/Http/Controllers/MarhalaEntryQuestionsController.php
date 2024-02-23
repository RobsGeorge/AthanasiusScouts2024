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

class MarhalaEntryQuestionsController extends Controller
{
/**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {
            $marahel = DB::table('Marhala')->get();
            $entryQuestions = DB::table('MarhalaEntryQuestions')->get();
            return view("entry-questions-index", array('entryQuestions' => $entryQuestions, 'marahel'=>$marahel, 'title'=> "الأسئلة"));
        }

        public function create()
        {
            $marahel = DB::table('Marhala')->get();
            $questionTypes = DB::table('QuestionsTypes')->get();
            return view("entry-questions-create", array('marahel'=>$marahel, 'questionTypes' => $questionTypes));
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
            return redirect()->route('entry-questions.index')->with('status',' :تم ادخال بنجاح السؤال' .$thisQuestionID);
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
            $questionTypes = DB::table('QuestionsTypes')->get();
            $marahel = DB::table('Marhala')->get();
            $entryQuestions = DB::table('MarhalaEntryQuestions')->where('QuestionID', $id)->first();
            //print_r($rotab->RotbaID);
            return view("entry-questions-edit", array('entryQuestions' => $entryQuestions, 'marahel'=>$marahel, 'questionTypes'=>$questionTypes,'title'=> "تعديل سؤال"));
        }
    
        public function updates(Request $request, $id)
        {
            $entryQuestions = DB::table('MarhalaEntryQuestions')->where('QuestionID', $id)->first();

            $affected = DB::table('MarhalaEntryQuestions')->where('QuestionID', $id)->update(['QuestionText' => $request->question_text, 'RequiredAnswerType'=> $request->required_answer_type]);
            
            return redirect()->route('entry-questions.index')->with('status','تم تعديل بنجاح السؤال');
        }
    
        public function deletes($id)
        {
            $marahel = DB::table('Marhala')->get();
            $entryQuestions = DB::table('MarhalaEntryQuestions')->where('QuestionID', $id)->first();
            return view("entry-questions-delete", array('marahel' => $marahel, 'entryQuestions' => $entryQuestions, 'title'=> "حذف رتبة كشفية"));
        }

        public function destroy($id)
        {
            $deleted = DB::table('MarhalaEntryQuestions')->where('QuestionID',$id)->delete();

            return redirect()->route('entry-questions.index')->with('status','تم الغاء السؤال بنجاح');
        }
}