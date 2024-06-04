<div class="card shadow mb-4">
    <form class="user" id="regForm" method="post" action="{{ route('group.update', $groupSelected->GroupID1) }}">
        @method('PATCH')
        @csrf
        <div class="card-header py-3">
            <div class="col mb-3 mb-sm-0">
                <div class="card-header">        
                    <div class="form-group" dir="rtl" style="text-align: right">
                        <label for="grouptype" style="font-family: 'Cairo', sans-serif;">اختر نوع المجموعة</label>
                        <br />
                        <select class="form-control col-sm-4 select2" style="margin-right: 20px;" name="group_type_id" id="group_type_id">
                            <option style="font-family: 'Cairo', sans-serif; color: black; font-size: large" disabled selected>{{$groupSelected->GroupTypeName}}</option>
                            @foreach($groupTypes as $groupType)
                                <option style="font-family: 'Cairo', sans-serif; color: black;" value="{{$groupType->GroupTypeID}}">{{$groupType->GroupTypeName}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" dir="rtl" style="text-align: right">
                        <label for="group" style="font-family: 'Cairo', sans-serif;">اختر المجموعة التي تتضمنها (المجموعة الأكبر منها)</label>
                        <br />
                        <select class="form-control col-sm-4 select2" style="margin-right: 20px;" name="included_under_group_id" id="included_under_group_id">
                            <option style="font-family: 'Cairo', sans-serif; color: black; font-size: large"  disabled selected>{{$groupSelected->GroupInfo}}</option>
                            @foreach($groups as $group)
                                <option style="font-family: 'Cairo', sans-serif; color: black;" value="{{$group->IncludedUnderGroupID}}">{{$group->GroupInfo}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" dir="rtl" style="text-align: right">
                        <label for="groupSelected" style="font-family: 'Cairo', sans-serif;">اسم المجموعة</label>
                        <input type="text" class="form-control form-control-user" name="group_name" id="group_name" style="font-family: 'Cairo', sans-serif; font-size: medium"
                                placeholder="ادخل اسم المجموعة" onfocusout="myFunction()" value="{{$groupSelected->GroupName}}">
                        <br>
                        <input type="submit" class="btn-google btn-user btn-block" style="background-color: brown;" id="submit-button" value="تعديل"></input>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
