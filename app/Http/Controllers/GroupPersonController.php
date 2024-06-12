<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Session;

class GroupPersonController extends Controller
{
/**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {

            $groupPersons = DB::select("
                                    SELECT PersonGroup.*, PersonInformation.PersonID, PersonInformation.ShamandoraCode, 
                                        CONCAT(PersonInformation.FirstName, ' ', 
                                        PersonInformation.SecondName, ' ', PersonInformation.ThirdName) AS PersonFullName,
                                        GroupRole.GroupRoleName, 
                                        CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupDetails
                                    FROM PersonGroup
                                    LEFT JOIN PersonInformation ON PersonGroup.PersonID = PersonInformation.PersonID
                                    LEFT JOIN GroupTable ON GroupTable.GroupID = PersonGroup.GroupID
                                    LEFT JOIN GroupRole ON GroupRole.GroupRoleID = PersonGroup.GroupRoleID
                                    LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
                                    ");
            
            return view("group-person.index", array('groupPersons' => $groupPersons));
        }

        public function createKhadem()
        {

            $groups = DB::select("  SELECT  GroupTable.GroupID, 
                                            CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupInfo
                                    FROM GroupTable
                                    LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
                                ");
            $persons = DB::select("SELECT PersonInformation.PersonID, PersonInformation.ShamandoraCode, 
                                        CONCAT(PersonInformation.ShamandoraCode, ' ', PersonInformation.FirstName, ' ', PersonInformation.SecondName, ' ', PersonInformation.ThirdName) AS FullName
                                    FROM PersonInformation
                                    LEFT JOIN PersonQetaa ON PersonInformation.PersonID = PersonQetaa.PersonID
                                    LEFT JOIN Qetaa ON Qetaa.QetaaID = PersonQetaa.QetaaID
                                    WHERE Qetaa.QetaaName = ?", ['قادة']);
            $groupRoles = DB::select("SELECT * FROM GroupRole WHERE GroupRoleName != 'مخدوم'");
            $makhdoomGroupRole = NULL;
            $isKhadem = TRUE;
            return view("group-person.create", array('groups'=>$groups, 'persons'=>$persons, 'groupRoles'=>$groupRoles, 'isKhadem'=>$isKhadem, 'makhdoomGroupRole'=>$makhdoomGroupRole));
        }

        public function createMakhdoom()
        {
            
            $groups = DB::select("  SELECT  GroupTable.GroupID, 
                                            CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupInfo
                                    FROM GroupTable
                                    LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
                                ");
            $persons = DB::select("SELECT PersonInformation.PersonID, PersonInformation.ShamandoraCode, 
                                        CONCAT(PersonInformation.ShamandoraCode, ' ', PersonInformation.FirstName, ' ', PersonInformation.SecondName, ' ', PersonInformation.ThirdName, ' ', PersonInformation.FourthName) AS FullName
                                    FROM PersonInformation
                                    LEFT JOIN PersonQetaa ON PersonInformation.PersonID = PersonQetaa.PersonID
                                    LEFT JOIN Qetaa ON Qetaa.QetaaID = PersonQetaa.QetaaID
                                    WHERE Qetaa.QetaaName != ?", ['قادة']);
            $groupRoles = NULL;
            $makhdoomGroupRole = DB::selectOne("SELECT GroupRole.GroupRoleID, GroupRole.GroupRoleName
                                            From GroupRole
                                            WHERE GroupRole.GroupRoleName = ?
                                            ", ['مخدوم']);
            //return $makhdoomGroupRole;
            $isKhadem = FALSE;
            return view("group-person.create", array('groups'=>$groups, 'persons'=>$persons, 'groupRoles'=>$groupRoles, 'isKhadem'=>$isKhadem, 'makhdoomGroupRole'=>$makhdoomGroupRole));
        }


        public function insert(Request  $request)
        {

            $validator = Validator::make($request->all(), [
                'group_id' => 'required',
                'person_id' => 'required',
                'group_role_id' => 'required'
            ]);
     
            if ($validator->fails()) {
                return view('person.entry-error-repeat-trial');
            }   
        

            
            try{

                DB::beginTransaction();

                foreach($request->person_id as $personID)
                {
                    DB::table('PersonGroup')->insert(
                        array(
                            'PersonID' => $personID,
                            'GroupID' => $request -> group_id,
                            'GroupRoleID' => $request -> group_role_id
                        )
                    );
                }
            }
            catch(Exception $e)
            {
                dd($e->getMessage());
                DB::rollBack();
                return view('person.entry-error');
            }

            DB::commit();

            return redirect()->route('group-person.index');
        }
    
        public function edit($id)
        {
            $personGroupRoleRow = DB::selectOne("SELECT * FROM PersonGroup WHERE PersonGroupRoleID=?",[$id]);
            
            $isKhadem = FALSE;

            if(DB::selectOne("SELECT GroupRoleName FROM GroupRole WHERE GroupRoleID=?",[$personGroupRoleRow->GroupRoleID])->GroupRoleName!='مخدوم')
            {
                $isKhadem = TRUE;
            }

            if(!$isKhadem)
            {
                $makhdoomGroupRole = DB::selectOne("SELECT GroupRole.GroupRoleID, GroupRole.GroupRoleName
                                            From GroupRole
                                            WHERE GroupRole.GroupRoleName = ?
                                            ", ['مخدوم']);
                $groupRoles = NULL;
                $person = DB::selectOne("SELECT PersonID, 
                                        CONCAT(ShamandoraCode, ' ', FirstName, ' ', SecondName, ' ', ThirdName, ' ', FourthName) AS FullName 
                                        FROM PersonInformation WHERE PersonID=?",[$personGroupRoleRow->PersonID]);
                $selectedGroup = DB::selectOne("  SELECT  GroupTable.GroupID, 
                                        CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupInfo
                                        FROM GroupTable
                                        LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
                                        WHERE GroupTable.GroupID =?
                                    ", [$personGroupRoleRow->GroupID]);
                $selectedGroupRole = DB::selectOne("SELECT * FROM GroupRole
                                                    WHERE GroupRoleID=?", [$personGroupRoleRow->GroupRoleID]);
                                                    
                $groups = DB::select("  SELECT  GroupTable.GroupID, 
                    CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupInfo
                    FROM GroupTable
                    LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
    ");                
            }
            else
            {
                $makhdoomGroupRole = NULL;
                $groupRoles = DB::select("SELECT * FROM GroupRole WHERE GroupRoleName != 'مخدوم'");
                $person = DB::selectOne("SELECT PersonID, 
                                        CONCAT(ShamandoraCode, ' ', FirstName, ' ', SecondName, ' ', ThirdName, ' ', FourthName) AS FullName 
                                        FROM PersonInformation WHERE PersonID=?",[$personGroupRoleRow->PersonID]);
                $selectedGroup = DB::selectOne("  SELECT  GroupTable.GroupID, 
                                        CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupInfo
                                        FROM GroupTable
                                        LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
                                        WHERE GroupTable.GroupID =?
                                    ", [$personGroupRoleRow->GroupID]);
                $selectedGroupRole = DB::selectOne("SELECT * FROM GroupRole
                                                    WHERE GroupRoleID=?", [$personGroupRoleRow->GroupRoleID]);
                $groups = DB::select("  SELECT  GroupTable.GroupID, 
                    CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupInfo
                    FROM GroupTable
                    LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
    ");
                
            }

            //return $selectedGroup;

            return view("group-person.edit", 
                    array('makhdoomGroupRole'=>$makhdoomGroupRole, 
                    'groupRoles'=>$groupRoles, 
                    'person'=>$person, 
                    'selectedGroup'=>$selectedGroup, 
                    'groups'=>$groups, 
                    'personGroupRoleRow'=>$personGroupRoleRow,
                    'isKhadem'=>$isKhadem,
                    'selectedGroupRole'=>$selectedGroupRole
                ));
        }
    
        public function updates(Request $request, $id)
        {
            //return $request;
            $validator = Validator::make($request->all(), [
                'group_id' => 'required',
                'group_role_id' => 'required'
            ]);
     
            if ($validator->fails()) {
                return view('person.entry-error-repeat-trial');
            }
                
            DB::table('PersonGroup')->where('PersonGroupRoleID', $id)
            ->update([
                    'GroupID' => $request -> group_id,
                    'GroupRoleID' => $request -> group_role_id
            ]);

            return redirect()->route('group-person.index');
        }
    
        public function deletes($id)
        {
            $personGroupRoleRow = DB::table('PersonGroup')->where('PersonGroupRoleID', $id)->first();
            $person = DB::selectOne("SELECT PersonID, ShamandoraCode,
                                        CONCAT(FirstName, ' ', SecondName, ' ', ThirdName, ' ', FourthName) AS FullName 
                                        FROM PersonInformation WHERE PersonID=?",[$personGroupRoleRow->PersonID]);
            $selectedGroup = DB::selectOne("  SELECT  GroupTable.GroupID, 
                                        CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupInfo
                                        FROM GroupTable
                                        LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
                                        WHERE GroupTable.GroupID =?
                                    ", [$personGroupRoleRow->GroupID]);

            return view("group-person.delete", array('personGroupRoleRow' => $personGroupRoleRow, 'person'=> $person, 'selectedGroup' => $selectedGroup));
        }

        public function destroy($id)
        {
            try{
                DB::beginTransaction();
                DB::table('PersonGroup')->where('PersonGroupRoleID',$id)->delete();
            }
            catch(Exception $e)
            {
                dd($e->getMessage());
                DB::rollBack();
                return view('person.entry-error');
            }
            DB::commit();
            return redirect()->route('group-person.index');
        }
}