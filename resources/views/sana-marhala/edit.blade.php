@extends('layouts.app', ['pageTitle' => 'تعديل مرحلة دراسية مفصله'])
@section('content')


<x-form-card title="تعديل مرحلة دراسية مفصله" :action="route('sana-marhala.update', $sana->SanaMarhalaID)"
    method="PATCH" inputPlaceholder="ادخل اسم المرحلة الدراسية" inputLabel="اسم المرحلة الدراسية"
    submitText="تعديل مرحلة دراسية" submitColor="emerald" inputName="sana_marhala_name"
    :inputValue="$sana->SanaMarhalaName" />

@endsection