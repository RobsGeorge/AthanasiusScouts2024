@extends('layouts.app' , ['pageTitle' => "ملفي الشخصي"?? ''])
@section('content')
<div class="grid grid-flow-col grid-rows-2 gap-8 reverse ">
    <!-- Left Column: User Information -->
    <div class="rounded-lg shadow-md p-6 bg-white row-span-3 space-y-4 ">


        <div class="justify-items-center">

            <img src="{{ asset('img/mark.jpg') }}"
                class="size-full max-h-[12rem] max-w-[14rem]  shadow-sm rounded-md shadow-md">

        </div>


        <h2 class="text-2xl font-bold text-gray-800 border-b pb-2 text-center">معلومات المستخدم</h2>

        <div class="text-gray-700">
            <span class="font-medium">الاسم الكامل:</span>
            {{ Auth::user()->FirstName }} {{ Auth::user()->SecondName }} {{ Auth::user()->ThirdName }}
            {{ Auth::user()->FourthName }}
        </div>

        <div class="text-gray-700">
            <span class="font-medium">الرقم الكشفي:</span>
            {{ Auth::user()->ShamandoraCode }}
        </div>


    </div>


    <!-- Right Column: Recent Activities -->
    <div class="rounded-lg shadow-md bg-white  shadow-md p-6  col-span-2 space-y-4  ">
        <h2 class="text-2xl font-bold text-gray-800 border-b pb-2 text-center">معلومات الاتصال</h2>

        <div class="text-gray-700">
            <span class="font-medium">الاسم الكامل:</span>
            {{ Auth::user()->FirstName }} {{ Auth::user()->SecondName }} {{ Auth::user()->ThirdName }}
            {{ Auth::user()->FourthName }}
        </div>

        <div class="text-gray-700">
            <span class="font-medium">الرقم الكشفي:</span>
            {{ Auth::user()->ShamandoraCode }}
        </div>

        <div class="text-gray-700">
            <span class="font-medium">البريد الإلكتروني:</span>
            {{ Auth::user()->PersonalEmail }}
        </div>

        <div class="text-gray-700">
            <span class="font-medium">الرقم القومي:</span>
            {{ Auth::user()->RaqamQawmy }}
        </div>
    </div>
    <div class="rounded-lg shadow-md bg-white  shadow-md  p-6 col-span-2 row-span-2  space-y-4 ">
        <h2 class="text-2xl font-bold text-gray-800 border-b pb-2 text-center">معلومات المستخدم</h2>

        <div class="text-gray-700">
            <span class="font-medium">الاسم الكامل:</span>
            {{ Auth::user()->FirstName }} {{ Auth::user()->SecondName }} {{ Auth::user()->ThirdName }}
            {{ Auth::user()->FourthName }}
        </div>

        <div class="text-gray-700">
            <span class="font-medium">الرقم الكشفي:</span>
            {{ Auth::user()->ShamandoraCode }}
        </div>

        <div class="text-gray-700">
            <span class="font-medium">البريد الإلكتروني:</span>
            {{ Auth::user()->PersonalEmail }}
        </div>

        <div class="text-gray-700">
            <span class="font-medium">الرقم القومي:</span>
            {{ Auth::user()->RaqamQawmy }}
        </div>


    </div>


    @endsection