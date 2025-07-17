@extends('layouts.app' , ['pageTitle' => "الكليات"?? ''])

@section('content')

{{-- CREATE FORM - resources/views/faculty/create.blade.php --}}
<x-form-card title="اضافة كليه جديدة" :action="route('faculty.insert')" method="POST" inputPlaceholder="ادخل اسم الكلية"
    inputLabel="ادخل اسم الكلية" submitText="إضافة الكلية" submitColor="emerald" inputName="faculty_name"
    {{-- THIS MUST BE SET --}} />

@endsection