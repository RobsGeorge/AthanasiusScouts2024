@extends('layouts.app' , ['pageTitle' => "الجامعات"?? ''])

@section('content')


<x-form-card title="اضافة جامعه جديدة" :action="route('university.insert')" method="POST"
    inputPlaceholder="ادخل اسم الجامعه" inputLabel="ادخل اسم الجامعه" submitText="إضافة الجامعه" submitColor="emerald"
    inputName="university_name" {{-- THIS MUST BE SET --}} />

@endsection