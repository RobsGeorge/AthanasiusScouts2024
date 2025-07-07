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

        public function insert(Request $request)
        {

            $validated = $request->validate([
            'participant_name' => 'nullable|string|max:255',
            'main_team' => 'nullable|string|max:255',
            'sub_team' => 'nullable|string|max:255',
            'program_rating' => 'nullable|integer|min:1|max:10',
            'program_pros' => 'nullable|string',
            'program_cons' => 'nullable|string',
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