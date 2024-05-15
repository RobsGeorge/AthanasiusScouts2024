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

class MaxNumbersController extends Controller
{
/**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {
            // $qetaat = DB::table('Qetaa')->get();
            // $entryQuestions = DB::table('MaxNumbers')
            // ->Join('Qetaa', 'MaxNumbers.QetaaID', '=', 'Qetaa.QetaaID')
            // ->Join('QuestionsTypes', 'MaxNumbers.RequiredAnswerType', '=','QuestionsTypes.QuestionType')
            // ->select('MaxNumbers.*', 'Qetaa.QetaaName', 'QuestionsTypes.QuestionTypeInArabicWords')
            // ->get();

            return view("max-numbers.max-numbers-index");
        }

        public function create()
        {
            // $qetaat = DB::table('Qetaa')->get();
            // $questionTypes = DB::table('QuestionsTypes')->get();
            return view("max-numbers.max-numbers-create");
        }

     
  
      


}