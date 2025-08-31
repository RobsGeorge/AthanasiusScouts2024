@extends('layouts.app' , ['pageTitle' => "مسح المناسبة"?? ''])

@section('content')
<x-form-card title="مسح نوع المناسبة" :action="route('event.destroy', $event->EventID)" method="DELETE"
    :inputValue="$event->EventName" inputPlaceholder="ادخل اسم نوع المناسبة" inputLabel="مسح اسم نوع المناسبة"
    submitText="مسح" submitColor="red" pageTitle="المناسبات" />

@endsection