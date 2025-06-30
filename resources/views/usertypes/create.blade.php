<x-admin-layout>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Add New User Type`, pages: [
                                                        {name: `Dashboard`, url: `{{route('admin.dashboard')}}` }, 
                                                        {name: `User Type List`, url: `{{route('admin.userTypes.index')}}` }, 
                                                    ]
                    }">
            <x-breadcrumbs />
        </div>
        <!-- Breadcrumb End -->

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex justify-between px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-theme-xl font-medium text-gray-800 dark:text-white/90">
                        Enter User Type Details
                    </h3>
                    <a href="{{ route('admin.userTypes.index') }}" class="text-theme-lg font-medium text-gray-500 dark:text-white/90">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 inline -mt-0.5">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                        </svg>
                        Cancel
                    </a>
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <form 
                        method="post" 
                        action="{{ route('admin.userTypes.store') }}" 
                        class="space-y-6"
                    >
                        @csrf
                        
                        <x-toggle-switch 
                            name="status"
                            id="status" 
                            label="Status" 
                            checked="{{ (bool)old('status') }}"
                        />

                        <!-- Elements -->
                        <div>
                            <x-input-label for="type" :value="__('User Type')"/>

                            <x-text-input
                                type="text"
                                name="type"
                                id="type"
                                placeholder="User Type"
                                value="{{ old('type', '') }}"
                            />
                            
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>

                        <div class="flex items-center justify-start mt-4">
                            <x-secondary-link-button href="{{ route('admin.userTypes.index') }}">
                                Cancel
                            </x-secondary-link-button>
                
                            <x-primary-button class="ms-3">Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>