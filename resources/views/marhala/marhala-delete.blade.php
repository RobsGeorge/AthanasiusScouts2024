@extends('layouts.app' , ['pageTitle' => " المراحل الدراسية"?? ''])
@section('content')


<x-form-card title="مسح مرحله دراسية" :action="route('marhala.destroy', $marhala->MarhalaID)" method="DELETE"
    :inputValue="$marhala->MarhalaName" inputPlaceholder="ادخل مرحله دراسية" inputLabel="مسح مرحله دراسية"
    submitText="مسح" submitColor="red" />
@endsection