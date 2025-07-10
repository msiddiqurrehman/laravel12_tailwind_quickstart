<x-admin-layout>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Edit State '{{ $item->name }}'`, pages: [
                                                        {name: `Dashboard`, url: `{{route('admin.dashboard')}}` }, 
                                                        {name: `State List`, url: `{{route('admin.states.index')}}` }, 
                                                    ]
                    }">
            <x-breadcrumbs />
        </div>
        <!-- Breadcrumb End -->

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex justify-between px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-theme-xl font-medium text-gray-800 dark:text-white/90">
                        Edit State Details
                    </h3>
                    <a href="{{ route('admin.states.index') }}" class="text-theme-lg font-medium text-gray-500 dark:text-white/90">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 inline -mt-0.5">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                        </svg>
                        Cancel
                    </a>
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <form 
                        method="post" 
                        action="{{ route('admin.states.update', $item) }}" 
                        class="space-y-6"
                    >
                        @csrf
                        @method('PUT')
                        
                        <!-- Status -->
                        <x-toggle-switch 
                            name="status"
                            id="status" 
                            label="Status" 
                            checked="{{ (bool)old('status', $item->status) }}"
                        />

                        <!-- Country -->
                        <div>
                            <x-input-label for="country_id" :value="__('Country')" />

                            <x-select-input id="country_id" name="country_id">

                                <x-select-option value="" text="Select Country"/>

                                @foreach ($countries as $country)
                                    <x-select-option 
                                                    value="{{ $country->id }}" 
                                                    text="{{ $country->name }}" 
                                                    :is-selected="old('country_id', $item->country_id) == $country->id" 
                                    />
                                @endforeach

                            </x-select-input>

                            <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
                        </div>

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('State Name')"/>

                            <x-text-input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="State Name"
                                value="{{ old('name', $item->name) }}"
                                required
                            />
                            
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="flex items-center justify-start mt-4">
                            <x-secondary-link-button href="{{ route('admin.designations.index') }}">
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