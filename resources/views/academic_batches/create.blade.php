<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

            
        <x-input-error :messages="$errors" />

        <div class="m-4">
            <x-session-status></x-session-status>
        </div>


        <form role="form" method="post" action="{{route('academics.batches.store')}}"  enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="mt-4">
            
            <label class="" for="batch">Select Your New Academic Batch</label>
            
            <div class="relative mt-4 max-w-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
                </div>
                <input id="batch" readonly="readonly" type="text" name="batch" class="datepicker2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
            </div>
            
            </div>

            <x-bladewind::button can_submit="true" class="mt-5" size="small" radius="small">Create Batch</x-bladewind::button>

            {{-- <button type="submit" class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Create Role</button> --}}

        </form>



        </div>



        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        @endpush

        @push('styles')
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">

        @endpush

        <script>

            $(".datepicker2").flatpickr({
                mode: "range",
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });

        </script>
</x-app-layout>


