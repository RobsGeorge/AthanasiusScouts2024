@extends('layouts.app' , ['pageTitle' => " المراحل الدراسية"?? ''])

@section('content')
<x-form-card title="اضافة مرحله دراسية" :action="route('marhala.update', $marhala->MarhalaID)" method="PATCH"
    :inputValue="$marhala->MarhalaName" inputPlaceholder="ادخل مرحله دراسية" inputLabel="ادخل مرحله دراسية"
    submitText="تعديل" submitColor="emerald" inputName="marhala_name" />
@endsection