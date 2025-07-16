@extends('layouts.app' , ['pageTitle' => "فصائل الدم"?? ''])

@section('content')
<x-form-card title="مسح فصيله دم" :action="route('person.destroy', $person->PersonID)" method="DELETE"
    :inputValue="$person->ShamandoraCode" inputPlaceholder="ادخل فصيله دم" inputLabel="مسح فصيله دم" submitText="مسح"
    submitColor="red" />

@endsection