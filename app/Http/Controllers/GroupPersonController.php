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
use App\Http\Controllers\stdClass;
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
            
            $groupsResult =   DB::select("SELECT g1.GroupID,  
                                    CONCAT('مجموعة رقم: ', g1.GroupID, ' - ',g3.GroupTypeName, ' ', g1.GroupName, ' -> ', g4.GroupTypeName, ' ', g2.GroupName) AS GroupInfo   
                                    FROM GroupTable g1
                                    LEFT JOIN GroupTable g2 ON g1.IncludedUnderGroupID = g2.GroupID
                                    LEFT JOIN GroupType g3 ON g1.GroupTypeID = g3.GroupTypeID
                                    LEFT JOIN GroupType g4 ON g2.GroupTypeID = g4.GroupTypeID
                                    WHERE g1.GroupID > 0
                                    ");


            $groups = [];
            foreach($groupsResult as $g)
            {
                $object = new \stdClass;
                $object->GroupID = $g->GroupID;
                $object->GroupInfo = GroupPersonController::getParentsPathString($g->GroupID);
                array_push($groups, $object);
            }

            $persons = DB::select("SELECT PersonInformation.PersonID, PersonInformation.ShamandoraCode, 
                                        CONCAT(PersonInformation.ShamandoraCode, ' ', PersonInformation.FirstName, ' ', PersonInformation.SecondName, ' ', PersonInformation.ThirdName) AS FullName
                                    FROM PersonInformation
                                    LEFT JOIN PersonQetaa ON PersonInformation.PersonID = PersonQetaa.PersonID
                                    LEFT JOIN Qetaa ON Qetaa.QetaaID = PersonQetaa.QetaaID
                                    WHERE Qetaa.QetaaName = ?", ['قادة']);
            $groupRoles = DB::select("SELECT * FROM GroupRole WHERE isKhademRole = 1");

            $isKhadem = TRUE;
            return view("group-person.create", array('groups'=>$groups, 'persons'=>$persons, 'groupRoles'=>$groupRoles, 'isKhadem'=>$isKhadem));
        }

         public function createMakhdoom()
        {
            // Fetch all groups (courses) as per createKhadem, but ensure they are relevant for makhdoom
            $groupsResult = DB::select("SELECT g1.GroupID,  
                                    CONCAT('مجموعة رقم: ', g1.GroupID, ' - ',g3.GroupTypeName, ' ', g1.GroupName, ' -> ', g4.GroupTypeName, ' ', g2.GroupName) AS GroupInfo   
                                    FROM GroupTable g1
                                    LEFT JOIN GroupTable g2 ON g1.IncludedUnderGroupID = g2.GroupID
                                    LEFT JOIN GroupType g3 ON g1.GroupTypeID = g3.GroupTypeID
                                    LEFT JOIN GroupType g4 ON g2.GroupTypeID = g4.GroupTypeID
                                    WHERE g1.GroupID > 0
                                    ");

            $groups = [];
            foreach($groupsResult as $g)
            {
                $object = new \stdClass;
                $object->GroupID = $g->GroupID;
                $object->GroupInfo = GroupPersonController::getParentsPathString($g->GroupID);
                array_push($groups, $object);
            }

            // Fetch all persons (students) without initial filtering, as user will select who attends
            $persons = DB::select("SELECT PersonInformation.PersonID, PersonInformation.ShamandoraCode, 
                                        CONCAT(PersonInformation.ShamandoraCode, ' ', PersonInformation.FirstName, ' ', PersonInformation.SecondName, ' ', PersonInformation.ThirdName) AS FullName
                                    FROM PersonInformation
                                    ");

            // Fetch group roles relevant for makhdoom (students)
            $groupRoles = DB::select("SELECT GroupRole.GroupRoleID, GroupRole.GroupRoleName
                                            From GroupRole
                                            WHERE GroupRole.isKhademRole = 0");

            $isKhadem = FALSE;
            return view("group-person.create", array('groups'=>$groups, 'persons'=>$persons, 'groupRoles'=>$groupRoles, 'isKhadem'=>$isKhadem));
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

            if(DB::selectOne("SELECT isKhademRole FROM GroupRole WHERE GroupRoleID=?",[$personGroupRoleRow->GroupRoleID])->isKhademRole)
            {
                $isKhadem = TRUE;
            }

            if(!$isKhadem)
            {
                $groupRoles = DB::select("SELECT GroupRole.GroupRoleID, GroupRole.GroupRoleName
                                            From GroupRole
                                            WHERE GroupRole.isKhademRole = 0");
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
                                                    
                $khademAuthenticatedID = Auth::user()->PersonID;
                $directGroupsConnectedToKhadem = DB::select("SELECT PersonGroup.GroupID FROM PersonGroup WHERE PersonID = ?", [$khademAuthenticatedID]);
    
                $groups = NULL;
    
                if($directGroupsConnectedToKhadem != NULL)
                {
                    $allGroupsIDsBelowKhadem = [];
                    foreach($directGroupsConnectedToKhadem as $groupConnected)
                    {
                        $allGroupsIDsBelowKhadem = array_merge($allGroupsIDsBelowKhadem, GroupPersonController::getNodesBelow($groupConnected->GroupID, [$groupConnected->GroupID]));
                    }
    
                    $groups = [];
                    foreach($allGroupsIDsBelowKhadem as $g)
                    {
                        $object = new \stdClass;
                        $object->GroupID = $g;
                        $object->GroupInfo = GroupPersonController::getParentsPathString($g);
                        array_push($groups, $object);
                    }             
                }
            }
            else
            {

                $groupRoles = DB::select("SELECT * FROM GroupRole WHERE isKhademRole = 1");
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
                    array(
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

        private function getNodesBelow($groupID, $orgIDs)
        {
            if ($groupID==NULL)
                return NULL;
            
            $sql = "SELECT GroupID FROM GroupTable WHERE GroupTable.IncludedUnderGroupID = $groupID";
            $sql_result = DB::select($sql);

            foreach($sql_result as $row)
            {
                array_push($orgIDs, $row->GroupID);
                $orgIDs = array_merge($orgIDs, GroupPersonController::getNodesBelow($row->GroupID, []));
            }

            return $orgIDs;
        }

        private function getParentsPathString($groupID)
        {
            if ($groupID==0)
                return DB::selectOne("  SELECT  
                                            CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupInfo,
                                            GroupTable.IncludedUnderGroupID
                                            FROM GroupTable
                                            LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
                                            WHERE GroupTable.GroupID = $groupID")->GroupInfo;
            
            $selectedGroup = DB::selectOne("  SELECT  
                CONCAT(GroupType.GroupTypeName, ' ', GroupTable.GroupName) AS GroupInfo,
                GroupTable.IncludedUnderGroupID
                FROM GroupTable
                LEFT JOIN GroupType ON GroupTable.GroupTypeID = GroupType.GroupTypeID
                WHERE GroupTable.GroupID = $groupID");
            

            $path = $selectedGroup->GroupInfo." -> ".GroupPersonController::getParentsPathString($selectedGroup->IncludedUnderGroupID);

            return $path;
            
        }

        private function getLatestParentBeforeRoot($groupID)
        {   
            $parentID = DB::selectOne("     SELECT  GroupTable.IncludedUnderGroupID
                                            FROM    GroupTable
                                            WHERE   GroupTable.GroupID = $groupID")->IncludedUnderGroupID;
            if($parentID==0)
                return $groupID;
            
            return GroupPersonController::getLatestParentBeforeRoot($parentID);

        }
}