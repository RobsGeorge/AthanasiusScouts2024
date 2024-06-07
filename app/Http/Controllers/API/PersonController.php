<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Illuminate\Http\Response;
use Session;


class PersonController extends Controller
{

    //Given a Certain Qetaa ID -> Fetch all the Data of the Persons realted to this Qetaa
    public function getPersonDataByQetaaID()
    {
        $qetaa_id = 1; //Qetaa for Testing for Bara3em
        $data = DB::select("SELECT DISTINCT  
                                                    pi.ShamandoraCode,
                                                    pi.FirstName, 
                                                    pi.SecondName, 
                                                    pi.ThirdName, 
                                                    pi.FourthName, 
                                                    q.QetaaName,
                                                    pi.ScoutJoiningYear,
                                                    sm.SanaMarhalaName, 
                                                    pi.RaqamQawmy,
                                                    ppn.PersonPersonalMobileNumber
                                                FROM PersonInformation pi
                                                LEFT JOIN PersonEntryQuestions peq ON pi.PersonID = peq.PersonID 
                                                LEFT JOIN PersonSanaMarhala psm ON psm.PersonID = pi.PersonID
                                                LEFT JOIN SanaMarhala sm ON sm.SanaMarhalaID = psm.SanaMarhalaID
                                                LEFT JOIN PersonQetaa pq ON pi.PersonID = pq.PersonID
                                                LEFT JOIN Qetaa q ON pq.QetaaID = q.QetaaID
                                                LEFT JOIN PersonPhoneNumbers ppn ON pi.PersonID = ppn.PersonID
                                                WHERE q.QetaaID = ?;", [$qetaa_id]);
        
        
        return response()->json(['data'=>$data, 'status'=>200]);
    }
}

?>