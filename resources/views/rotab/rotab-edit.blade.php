@extends('layouts.app' , ['pageTitle' => "الرتب الكشفيه"?? ''])
@section('content')
<x-form-card title="تعديل الجامعه" :action="route('rotab.update', $rotab->RotbaID)" method="PATCH"
    :inputValue="$rotab->RotbaName" inputPlaceholder="ادخل اسم الجامعه" inputLabel="تعديل اسم الجامعه"
    submitText="تعديل" submitColor="emerald" inputName="rotba_name" />
@endsection