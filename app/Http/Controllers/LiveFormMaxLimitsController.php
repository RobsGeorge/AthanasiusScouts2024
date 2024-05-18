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

class LiveFormMaxLimitsController extends Controller
{
/**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {
            $marahelLimits = DB::table('MarhalaLiveFormLimit')
            ->join('SanaMarhala','SanaMarhala.SanaMarhalaID','=','MarhalaLiveFormLimit.SanaMarhalaID')
            ->get();

            //return $marahelLimits;

            return view("max-limits.index", array('marahelLimits' => $marahelLimits));
        }

        public function create()
        {
            $marahel = DB::table('SanaMarhala')->get();
            return view("max-limits.create", array('marahel'=>$marahel));
        }

        public function insert(Request  $request)
        {
            $lastQuestionID = DB::table('MarhalaLiveFormLimit')->orderBy('SanaMarhalaID','desc')->first();
            
            if($lastQuestionID==Null)
                $thisQuestionID = 1;
            else
                $thisQuestionID = $lastQuestionID->SanaMarhalaID + 1;
            
            
            DB::table('MarhalaLiveFormLimit')->insert(
                    array(
                        'SanaMarhalaID' => $thisQuestionID,
                        'MaxLimit' => $request -> max_limit,
                        'Year' => $request -> joindate,
                    )
                );
            
            return redirect()->route('max-limits.index');
            
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
            //$marahel = DB::table('SanaMarhala')->get();
            $marhalaSelected = DB::table('MarhalaLiveFormLimit')
                            ->where('MarhalaLiveFormLimit.SanaMarhalaID', '=', $id)
                            ->Join('SanaMarhala', 'SanaMarhala.SanaMarhalaID', '=', 'MarhalaLiveFormLimit.SanaMarhalaID')
                            ->first();
            return view("max-limits.edit", array('marhalaSelected'=>$marhalaSelected));
        }
    
        public function updates(Request $request, $id)
        {

            DB::table('MarhalaLiveFormLimit')
                ->where('SanaMarhalaID',$id)
                ->update(
                [
                    'MaxLimit' => $request -> max_limit,
                ]
            );
            
            return redirect()->route('max-limits.index');

        }
    
        public function deletes($id)
        {
            //$marahelLimits = DB::table('MarhalaLiveFormLimit')->get();
            $selectedMarhala = DB::table('MarhalaLiveFormLimit')->where('SanaMarhalaID', $id)->first();
            return view("max-limits.delete", array('selectedMarhala'=>$selectedMarhala));
        }

        public function destroy($id)
        {
            DB::table('MarhalaLiveFormLimit')->where('SanaMarhalaID',$id)->delete();
            return redirect()->route('max-limits.index');
        }
}