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
use App\Models\Feedback;

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

        public function create(Request $request)
        {

            $validated = $request->validate([
            'participant_name' => 'nullable|string|max:255',
            'main_team' => 'nullable|string|max:255',
            'sub_team' => 'nullable|string|max:255',
            'program_rating' => 'nullable|integer|min:1|max:10',
            'program_pros' => 'nullable|string',
            'program_cons' => 'nullable|string',
            'leaders_rating' => 'nullable|integer|min:1|max:10',
            'leaders_pros' => 'nullable|string',
            'leaders_cons' => 'nullable|string',
            'games_rating' => 'nullable|integer|min:1|max:10',
            'games_pros' => 'nullable|string',
            'games_cons' => 'nullable|string',
            'goal_delivery_rating' => 'nullable|integer|min:1|max:10',
            'goal_delivery_pros' => 'nullable|string',
            'goal_delivery_cons' => 'nullable|string',
            'logo_rating' => 'nullable|integer|min:1|max:10',
            'logo_pros' => 'nullable|string',
            'logo_cons' => 'nullable|string',
            'gift_rating' => 'nullable|integer|min:1|max:10',
            'gift_pros' => 'nullable|string',
            'gift_cons' => 'nullable|string',
            'secretary_rating' => 'nullable|integer|min:1|max:10',
            'secretary_pros' => 'nullable|string',
            'secretary_cons' => 'nullable|string',
            'media_rating' => 'nullable|integer|min:1|max:10',
            'media_pros' => 'nullable|string',
            'media_cons' => 'nullable|string',
            'emergency_rating' => 'nullable|integer|min:1|max:10',
            'emergency_pros' => 'nullable|string',
            'emergency_cons' => 'nullable|string',
            'kitchen_rating' => 'nullable|integer|min:1|max:10',
            'kitchen_pros' => 'nullable|string',
            'kitchen_cons' => 'nullable|string',
            'finance_rating' => 'nullable|integer|min:1|max:10',
            'finance_pros' => 'nullable|string',
            'finance_cons' => 'nullable|string',
            'custody_rating' => 'nullable|integer|min:1|max:10',
            'custody_pros' => 'nullable|string',
            'custody_cons' => 'nullable|string',
            'purchase_rating' => 'nullable|integer|min:1|max:10',
            'purchase_pros' => 'nullable|string',
            'purchase_cons' => 'nullable|string',
            'transportation_rating' => 'nullable|integer|min:1|max:10',
            'transportation_pros' => 'nullable|string',
            'transportation_cons' => 'nullable|string',
            'general_suggestions' => 'nullable|string',
        ]);

            Feedback::create($validated);

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