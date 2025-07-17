@extends('layouts.app' , ['pageTitle' => "إضافة حي سكني" ?? ''])
@section('content')
<div class="container mx-auto px-4 py-8">
    <x-form-card title="إضافة حي سكني جديد" :action="route('district.insert')" method="POST"
        inputPlaceholder="ادخل اسم الحي السكني" inputLabel="ادخل اسم الحي السكني" submitText="إضافة الحي السكني"
        submitColor="emerald" inputName="district_name" />
</div>
@endsection