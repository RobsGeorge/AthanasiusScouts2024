@extends('layouts.app', ['pageTitle' => 'تعديل قطاع كشفي'])
@section('content')

<x-form-card title="تعديل قطاع كشفي" :action="route('qetaa.update', $qetaa->QetaaID)" method="PATCH"
    inputPlaceholder="ادخل اسم القطاع" inputLabel="اسم القطاع" submitText="تعديل" submitColor="emerald"
    inputName="qetaa_name" :inputValue="$qetaa->QetaaName" />

@endsection