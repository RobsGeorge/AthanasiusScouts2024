@extends('layouts.app' , ['pageTitle' => "حذف دور/مهمة" ?? ''])
@section('content')


<x-form-card title="حذف دور/مهمة" :action="route('role.destroy', $role->RoleID)" method="DELETE"
    inputPlaceholder="ادخل اسم الدور/المهمة" inputLabel="ادخل اسم الدور/المهمة" submitText="حذف الدور/المهمة"
    submitColor="red" inputName="role_name" :inputValue="$role->RoleName" />

@endsection