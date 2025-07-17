@extends('layouts.app', ['pageTitle' => 'إضافة قطاع كشفي'])
@section('content')

<x-form-card title="إضافة قطاع كشفي" :action="route('qetaa.insert')" method="POST" inputPlaceholder="ادخل اسم القطاع"
    inputLabel="اسم القطاع" submitText="إضافة قطاع" submitColor="blue" inputName="qetaa_name" />

@endsection