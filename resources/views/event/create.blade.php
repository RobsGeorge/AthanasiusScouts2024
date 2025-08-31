@extends('layouts.app', ['pageTitle' => "إضافة حدث/مناسبة" ?? ''])

@section('content')

<div class="container-fluid">

    <!-- Event Form using x-form-card concept -->
    <div class="flex place-content-center mb-8">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-4xl border-2 border-blue-300" dir="rtl">
            <!-- Card Title -->
            <div class="mb-6 text-center">
                <h2 class="text-xl font-bold text-gray-800" style="font-family: 'Cairo', sans-serif;">
                    اضافة حدث/مناسبة جديدة
                </h2>
            </div>

            <form class="user" id="regForm" method="POST" action="{{ route('event.insert') }}">
                @csrf
                <div class="space-y-6">

                    <!-- Event Type Selection -->
                    <div class="relative">
                        <label for="event_type_id" class="block mb-2 text-sm font-medium text-slate-700"
                            style="font-family: 'Cairo', sans-serif; text-align: right;">
                            نوع الحدث أو المناسبة الكشفية
                        </label>
                        <select name="event_type_id" id="event_type_id" required
                            class="w-full h-12 px-4 text-sm border rounded-lg border-slate-200 text-slate-500 focus:border-blue-300 focus:outline-none text-right"
                            style="font-family: 'Cairo', sans-serif; font-size: medium">
                            <option value="" disabled selected>اختر نوع الحدث أو المناسبة الكشفية</option>
                            @foreach($eventTypes as $eventType)
                            <option style="font-family: 'Cairo', sans-serif; color: black;"
                                value="{{$eventType->EventTypeID}}">
                                {{$eventType->EventTypeName}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Event Name -->
                    <div class="relative">
                        <input id="event_name" type="text" name="event_name" required
                            placeholder="ادخل اسم الحدث أو المناسبة" onfocusout="myFunction()"
                            class="relative w-full h-12 px-4 text-sm placeholder-transparent transition-all border rounded-lg outline-none focus-visible:outline-none peer border-slate-200 text-slate-500 autofill:bg-white invalid:border-blue-300 invalid:text-blue-300 focus:border-blue-400 focus:outline-none invalid:focus:border-blue-400 disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400 text-right"
                            style="font-family: 'Cairo', sans-serif; font-size: medium" />
                        <label for="event_name"
                            class="cursor-text peer-focus:cursor-default peer-autofill:-top-2 absolute right-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:right-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-required:after:text-blue-500 peer-required:after:content-['\00a0*'] peer-invalid:text-blue-500 peer-focus:-top-2 peer-focus:text-xs peer-focus:text-blue-300 peer-invalid:peer-focus:text-blue-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent"
                            style="font-family: 'Cairo', sans-serif;">
                            اسم الحدث أو المناسبة الكشفية
                        </label>
                    </div>

                    <!-- Qetaa Multi-Selection with Checkboxes -->
                    <div class="relative">
                        <label class="block mb-2 text-sm font-medium text-slate-700"
                            style="font-family: 'Cairo', sans-serif; text-align: right;">
                            اختر القطاعات المربوطة بهذا الحدث
                        </label>
                        <div class="border rounded-lg border-slate-200 p-4 bg-white min-h-32 max-h-48 overflow-y-auto">
                            @foreach($qetaat as $qetaa)
                            <label class="flex items-center mb-2 cursor-pointer hover:bg-slate-50 p-2 rounded"
                                style="font-family: 'Cairo', sans-serif; direction: rtl;">
                                <input type="checkbox" name="qetaa_id[]" value="{{$qetaa->QetaaID}}"
                                    class="ml-2 w-4 h-4 text-blue-300 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <span class="text-sm text-slate-700" style="font-family: 'Cairo', sans-serif;">
                                    {{$qetaa->QetaaName}}
                                </span>
                            </label>
                            @endforeach
                        </div>
                        <div id="qetaa-validation-error" class="hidden text-red-500 text-xs mt-1"
                            style="font-family: 'Cairo', sans-serif; text-align: right;">
                            يرجى اختيار قطاع واحد على الأقل
                        </div>
                    </div>

                    <!-- Date Fields Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Start Date -->
                        <div class="relative">
                            <input id="event_start_date" type="date" name="event_start_date" required
                                class="relative w-full h-12 px-4 text-sm transition-all border rounded-lg outline-none focus-visible:outline-none peer border-slate-200 text-slate-500 focus:border-blue-500 focus:outline-none disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400 text-right"
                                style="font-family: 'Cairo', sans-serif; font-size: medium" />
                            <label for="event_start_date"
                                class="cursor-text absolute right-2 -top-2 z-[1] px-2 text-xs text-slate-400 bg-white"
                                style="font-family: 'Cairo', sans-serif;">
                                تاريخ بداية الحدث
                            </label>
                        </div>

                        <!-- End Date -->
                        <div class="relative">
                            <input id="event_end_date" type="date" name="event_end_date" required
                                class="relative w-full h-12 px-4 text-sm transition-all border rounded-lg outline-none focus-visible:outline-none peer border-slate-200 text-slate-500 focus:border-blue-500 focus:outline-none disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400 text-right"
                                style="font-family: 'Cairo', sans-serif; font-size: medium" />
                            <label for="event_end_date"
                                class="cursor-text absolute right-2 -top-2 z-[1] px-2 text-xs text-slate-400 bg-white"
                                style="font-family: 'Cairo', sans-serif;">
                                تاريخ نهاية الحدث
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center pt-6">
                        <button type="submit" id="submit-button"
                            class="inline-flex items-center justify-center h-12 gap-2 px-8 text-sm font-medium tracking-wide transition duration-300 rounded-full focus-visible:outline-none whitespace-nowrap bg-blue-50 text-blue-500 hover:bg-blue-100 hover:text-blue-600 focus:bg-blue-200 focus:text-blue-700 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-100 disabled:text-blue-400 disabled:shadow-none cursor-pointer"
                            style="font-family: 'Cairo', sans-serif; font-weight: bold;">
                            ادخال
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 only for event type dropdown
    $('#event_type_id').select2({
        theme: "classic",
        placeholder: "اختر نوع الحدث أو المناسبة الكشفية",
        dir: "rtl"
    });

    // Form validation with checkbox support
    $('#regForm').on('submit', function(e) {
        const eventType = $('#event_type_id').val();
        const eventName = $('#event_name').val();
        const qetaaCheckboxes = $('input[name="qetaa_id[]"]:checked');
        const startDate = $('#event_start_date').val();
        const endDate = $('#event_end_date').val();

        // Hide previous error message
        $('#qetaa-validation-error').addClass('hidden');

        // Validate all fields
        if (!eventType || !eventName || qetaaCheckboxes.length === 0 || !startDate || !endDate) {
            e.preventDefault();

            if (qetaaCheckboxes.length === 0) {
                $('#qetaa-validation-error').removeClass('hidden');
            }

            alert('يرجى ملء جميع الحقول المطلوبة');
            return false;
        }

        if (new Date(startDate) > new Date(endDate)) {
            e.preventDefault();
            alert('تاريخ بداية الحدث يجب أن يكون قبل تاريخ النهاية');
            return false;
        }
    });

    // Visual feedback for checkbox selection
    $('input[name="qetaa_id[]"]').on('change', function() {
        const label = $(this).parent();
        if ($(this).is(':checked')) {
            label.addClass('bg-blue-50 border-l-4 border-blue-500');
        } else {
            label.removeClass('bg-blue-50 border-l-4 border-blue-500');
        }

        // Hide error message when user selects at least one checkbox
        if ($('input[name="qetaa_id[]"]:checked').length > 0) {
            $('#qetaa-validation-error').addClass('hidden');
        }
    });
});

function myFunction() {
    // Custom validation function if needed
    console.log('Field validation triggered');
}
</script>
@endpush

@endsection