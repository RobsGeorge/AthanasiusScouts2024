@extends('layouts.app' , ['pageTitle' => "الكليات"?? ''])

@section('content')
<div class="min-h-screen flex place-items-center justify-center bg-gray-50  px-">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md 4" dir="rtl">
        <!-- Card Title -->
        <div class="mb-6 text-center">
            <h2 class="text-xl font-bold text-gray-800">مسح اسم الكلية</h2>
        </div>
        <form class="user" id="regForm" method="post" action="{{ route('faculty.destroy', $faculty->FacultyID) }}">
            @method('DELETE')
            @csrf
            <div class="space-y-6">
                <!-- Input Field -->



                <div class="relative">
                    <input id="faculty_name" type="text" name="faculty_name" placeholder="ادخل اسم الكلية"
                        onfocusout="myFunction()"
                        class="relative w-full h-12 px-4 text-sm placeholder-transparent transition-all border rounded-lg outline-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white invalid:border-pink-500 invalid:text-pink-500 focus:border-red-500 focus:outline-none invalid:focus:border-pink-500 disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400 text-right"
                        style="font-family: 'Cairo', sans-serif; font-size: medium" value="{{$faculty->FacultyName}}" />
                    <label for="faculty_name"
                        class="cursor-text peer-focus:cursor-default peer-autofill:-top-2 absolute right-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:right-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-required:after:text-pink-500 peer-required:after:content-['\00a0*'] peer-invalid:text-pink-500 peer-focus:-top-2 peer-focus:text-xs peer-focus:text-red-500 peer-invalid:peer-focus:text-pink-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent">
                        تعديل اسم الكلية
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <input type="submit" id="submit-button" value="مسح"
                        class="inline-flex items-center justify-center h-12 gap-2 px-8 text-sm font-medium tracking-wide transition duration-300 rounded-full focus-visible:outline-none whitespace-nowrap bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 focus:bg-red-200 focus:text-red-700 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-100 disabled:text-red-400 disabled:shadow-none">
                    </input>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection