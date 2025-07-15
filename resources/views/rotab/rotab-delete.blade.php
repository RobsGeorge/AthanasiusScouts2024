@extends('layouts.app' , ['pageTitle' => "الجامعات"?? ''])

@section('content')
<x-form-card title="مسح اسم الجامعه" :action="route('rotab.destroy', $rotab->RotbaID)" method="DELETE"
    :inputValue="$rotab->RotbaName" inputPlaceholder="ادخل اسم الجامعه" inputLabel="مسح اسم الجامعه" submitText="مسح"
    submitColor="red" inputName="rotba_name" />

@endsection