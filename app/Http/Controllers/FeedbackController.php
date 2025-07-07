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

class FeedbackController extends Controller
{
/**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {
            //$feedback = DB::table('Feedback')->get();
            return view("feedback.index");
        }

        public function insert(Request $request)
        {

            DB::table('Feedback')->insert([
    'participant_name'        => $request->participant_name,
    'main_team'               => $request->main_team,
    'sub_team'                => $request->sub_team,
    'program_rating'          => $request->program_rating,
    'program_pros'            => $request->program_pros,
    'program_cons'            => $request->program_cons,
    'leaders_rating'          => $request->leaders_rating,
    'leaders_pros'            => $request->leaders_pros,
    'leaders_cons'            => $request->leaders_cons,
    'games_rating'            => $request->games_rating,
    'games_pros'              => $request->games_pros,
    'games_cons'              => $request->games_cons,
    'goal_delivery_rating'    => $request->goal_delivery_rating,
    'goal_delivery_pros'      => $request->goal_delivery_pros,
    'goal_delivery_cons'      => $request->goal_delivery_cons,
    'logo_rating'             => $request->logo_rating,
    'logo_pros'               => $request->logo_pros,
    'logo_cons'               => $request->logo_cons,
    'gift_rating'             => $request->gift_rating,
    'gift_pros'               => $request->gift_pros,
    'gift_cons'               => $request->gift_cons,
    'secretary_rating'        => $request->secretary_rating,
    'secretary_pros'          => $request->secretary_pros,
    'secretary_cons'          => $request->secretary_cons,
    'media_rating'            => $request->media_rating,
    'media_pros'              => $request->media_pros,
    'media_cons'              => $request->media_cons,
    'emergency_rating'        => $request->emergency_rating,
    'emergency_pros'          => $request->emergency_pros,
    'emergency_cons'          => $request->emergency_cons,
    'kitchen_rating' => $request->kitchen_rating,
'kitchen_pros' => $request->kitchen_pros,
'kitchencons' => $request->kitchen_cons,
'finance_rating'   => $request->finance_rating,
'finance_pros' => $request->finance_pros,
'finance_cons' => $request->finance_cons,
'custody_rating'  => $request->custody_rating,
'custody_pros'  => $request->custody_pros,
'custody_cons' => $request->custody_cons,
'purchase_rating' => $request->purchase_rating,
'purchase_pros' => $request->purchase_pros,
'purchase_cons' => $request->purchase_cons,
    'transportation_rating'   => $request->transportation_rating,
    'transportation_pros'     => $request->transportation_pros,
    'transportation_cons'     => $request->transportation_cons,
    'general_suggestions'     => $request->general_suggestions,
]);

            return view('feedback.thanks');
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
            $faculty = DB::table('Faculty')->where('FacultyID', $id)->first();
            return view("faculty.edit", array('faculty' => $faculty));
        }
    
        public function updates(Request $request, $id)
        {
            $faculty = DB::table('Faculty')->where('FacultyID', $id)->first();

            $affected = DB::table('Faculty')->where('FacultyID', $id)->update(['FacultyName' => $request->faculty_name]);

            return redirect()->route('faculty.index');
        }
    
        public function deletes($id)
        {
            $faculty = DB::table('Faculty')->where('FacultyID', $id)->first();
            return view("faculty.delete", array('faculty' => $faculty));
        }

        public function destroy($id)
        {
            $deleted = DB::table('Faculty')->where('FacultyID',$id)->delete();
            
            return redirect()->route('faculty.index');
        }
}