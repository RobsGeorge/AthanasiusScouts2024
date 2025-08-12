@extends('layouts.app', ['pageTitle' => 'حذف قطاع كشفي'])
@section('content')


<x-form-card title="حذف قطاع كشفي" :action="route('qetaa.destroy', $qetaa->QetaaID)" method="DELETE"
    inputPlaceholder="ادخل اسم القطاع" inputLabel="اسم القطاع" submitText="حذف" submitColor="red" inputName="qetaa_name"
    :inputValue="$qetaa->QetaaName" />



@endsection