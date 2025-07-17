@extends('layouts.app' , ['pageTitle' => "حذف حي سكني" ?? ''])
@section('content')

<div class="container mx-auto px-4 py-8">
    <x-form-card title="حذف حي سكني" :action="route('district.destroy', $district->DistrictID)" method="DELETE"
        inputPlaceholder="ادخل اسم الحي السكني" inputLabel="ادخل اسم الحي السكني" submitText="حذف الحي السكني"
        submitColor="red" inputName="district_name" :inputValue="$district->DistrictName" />
</div>

@endsection