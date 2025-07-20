@extends('layouts.app', ['pageTitle' => 'حذف مرحلة دراسية مفصله'])
@section('content')


<x-form-card title="حذف مرحلة دراسية مفصله" :action="route('sana-marhala.destroy', $sana->SanaMarhalaID)"
    method="DELETE" inputPlaceholder="ادخل اسم المرحلة الدراسية" inputLabel="اسم المرحلة الدراسية" submitText="حذف"
    submitColor="red" inputName="sana_marhala_name" :inputValue="$sana->SanaMarhalaName" />

@endsection