@extends('layouts.app' , ['pageTitle' => " المراحل الدراسية"?? ''])

@section('content')

{{-- CREATE FORM - resources/views/faculty/create.blade.php --}}
<x-form-card title="اضافة مرحله دراسية" :action="route('marhala.insert')" method="POST"
    inputPlaceholder="ادخل مرحله دراسية" inputLabel="ادخل مرحله دراسية" submitText="إضافة مرحله دراسية "
    submitColor="blue" inputName="marhala_name" {{-- THIS MUST BE SET --}} />

@endsection