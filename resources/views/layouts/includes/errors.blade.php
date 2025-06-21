@session('success')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-3">
    <div class="bg-green-50 border-l-8 border-green-900">
        <div class="flex items-center">
            <div class="p-2">
                <div class="flex items-center">
                    <div class="ml-2">
                        <svg class="h-8 w-8 text-green-900 mr-2 cursor-pointer"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2l4 -4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="px-6 py-4 text-green-900 font-semibold text-lg">Success!</p>
                </div>
                <div class="px-16 mb-4">
                        <span class="text-green-600 ps-2">
                            {{ session('success') }}
                        </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsession

@if ($errors->any() || $errors->updatePassword->any())
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-3">
    <div class="bg-red-50 border-l-8 border-red-900">
        <div class="flex items-center">
            <div class="p-2">
                <div class="flex items-center">
                    <div class="ml-2">
                        <svg class="h-8 w-8 text-red-900 mr-2 cursor-pointer"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="px-6 py-4 text-red-900 font-semibold text-lg">Please fix the
                        following
                        errors.</p>
                </div>
                <div class="px-16 mb-4">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach

                    @foreach ($errors->updatePassword->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif