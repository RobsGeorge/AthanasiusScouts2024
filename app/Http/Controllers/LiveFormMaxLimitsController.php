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
            ->join('Qetaa','Qetaa.QetaaID','=','MarhalaLiveFormLimit.QetaaID')
            ->join('SanaMarhala','SanaMarhala.SanaMarhalaID','=','MarhalaLiveFormLimit.SanaMarhalaID')
            ->get();

            //return $marahelLimits;

            return view("max-limits.index", array('marahelLimits' => $marahelLimits));
        }

        public function create()
        {
            $qetaat = DB::table('Qetaa')->get();
            $senee_marahel = DB::table('SanaMarhala')->get();
            return view("max-limits.create", array('qetaat'=>$qetaat, 'seneen_marahel'=>$seneen_marahel));
        }

        public function insert(Request  $request)
        {   
            
            DB::table('MarhalaLiveFormLimit')->insert(
                    array(
                        'QetaaID' => $request->qetaa_id,
                        'SanaMarhalaID' => $request->sana_marhala_id,
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
        public function edit($id, $sana_id)
        {   //return $id;
            //$marahel = DB::table('SanaMarhala')->get();
            $marhalaSelected = DB::table('MarhalaLiveFormLimit')
                            ->where('MarhalaLiveFormLimit.QetaaID', '=', $id)
                            ->where('MarhalaLiveFormLimit.SanaMarhalaID','=',$sana_id)
                            ->Join('Qetaa', 'Qetaa.QetaaID', '=', 'MarhalaLiveFormLimit.QetaaID')
                            ->join('SanaMarhala','SanaMarhala.SanaMarhalaID','=','MarhalaLiveFormLimit.SanaMarhalaID')
                            ->first();
            return view("max-limits.edit", array('marhalaSelected'=>$marhalaSelected));
        }
    
        public function updates(Request $request, $id, $sana_id)
        {
            //return $request;
            DB::table('MarhalaLiveFormLimit')
                ->where('QetaaID',$id)
                ->where('SanaMarhalaID',$sana_id)
                ->update(
                [
                    'MaxLimit' => $request -> max_limit,
                ]
            );
            
            return redirect()->route('max-limits.index');

        }
    
        public function deletes($id,$sana_id)
        {
            //$marahelLimits = DB::table('MarhalaLiveFormLimit')->get();
            $selectedMarhala = DB::table('MarhalaLiveFormLimit')->where('QetaaID', $id)->where('SanaMarhalaID',$sana_id)->first();
            return view("max-limits.delete", array('selectedMarhala'=>$selectedMarhala));
        }

        public function destroy($id,$sana_id)
        {
            DB::table('MarhalaLiveFormLimit')->where('QetaaID',$id)->where('SanaMarhalaID',$sana_id)->delete();
            return redirect()->route('max-limits.index');
        }
}