@extends('layouts.app', ['pageTitle' => 'ربط القاده بالمهام'])

@section('content')
<div class="container mx-auto px-4 py-8" dir="rtl">

    <div class="bg-white shadow-md rounded-lg p-6 mb-8  border-2 border-blue-300">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">ربط قائد جديد بمهام</h2>
        <form method="POST" action="{{ route('person-role.insert') }}">
            @csrf

            <!-- Hidden Requester ID -->
            <input type="hidden" name="RequestPersonID" value="{{ Auth()->user()->PersonID }}">

            <!-- اختيار اسم الخادم -->
            <div class="mb-6">
                <label for="person_id" class="block text-sm font-semibold text-gray-700 mb-2">اختر اسم الخادم</label>
                <select id="person_id" name="person_id"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm py-2 px-4">
                    <option disabled selected value="">اختر اسم الخادم</option>
                    @foreach($khoddam as $khadem)
                    <option value="{{ $khadem->PersonID }}">{{ $khadem->PersonFullName }}</option>
                    @endforeach
                </select>
            </div>

            <!-- اختيار الدور/المهمة -->
            <div class="mb-6">
                <label for="role_id" class="block text-sm font-semibold text-gray-700 mb-2">اختر الدور/المهمة</label>
                <select id="role_id" name="role_id"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm py-2 px-4">
                    <option disabled selected value="">اختر الدور/المهمة</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->RoleID }}">{{ $role->RoleName }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit"
                    class="inline-flex items-center justify-center h-12 gap-2 px-8 text-sm font-medium tracking-wide transition duration-300 rounded-full focus-visible:outline-none whitespace-nowrap bg-blue-50 text-blue-500 hover:bg-blue-100 hover:text-blue-600 focus:bg-blue-200 focus:text-blue-700 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-100 disabled:text-blue-400 disabled:shadow-none">
                    إدخال
                </button>
            </div>
        </form>
    </div>

</div>
@endsection