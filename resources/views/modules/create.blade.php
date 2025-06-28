<x-admin-layout>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Add New Module`, pages: [
                                                        {name: `Dashboard`, url: `{{route('admin.dashboard')}}` }, 
                                                        {name: `Module List`, url: `{{route('admin.modules.index')}}` }, 
                                                    ]
                    }">
            <x-breadcrumbs />
        </div>
        <!-- Breadcrumb End -->

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex justify-between px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-theme-xl font-medium text-gray-800 dark:text-white/90">
                        Enter Module Details
                    </h3>
                    <a href="{{ route('admin.modules.index') }}" class="text-theme-lg font-medium text-gray-500 dark:text-white/90">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 inline -mt-0.5">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                        </svg>
                        Cancel
                    </a>
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <form 
                        method="post" 
                        action="{{ route('admin.modules.store') }}" 
                        class="space-y-6"
                        x-data="{moduleName:'{{ old('name') }}', moduleSlug:'{{ old('slug') }}' }"
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
                            <label for="name" class="mb-1.5 inline-block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Module Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="Module Name"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                x-model="moduleName"
                                @input="
                                        moduleSlug = moduleName.toLowerCase()
                                        {{-- // Replace one or more spaces with a single hyphen --}}
                                        .replace(/\s+/g, '-')
                                        {{-- // Remove any character that is not a letter, number, or hyphen --}}
                                        .replace(/[^a-z0-9-]/g, '')
                                        {{-- // Remove leading/trailing hyphens --}}
                                        .replace(/^-+|-+$/g, '');
                                        "
                            />
                        </div>

                        <!-- Elements -->
                        <div>
                            <label for="slug" class="mb-1.5 inline-block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Module Slug
                            </label>
                            <input
                                type="text"
                                name="slug"
                                id="slug"
                                placeholder="Module Slug"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                x-model="moduleSlug"
                            />
                        </div>

                        <div class="flex items-center justify-start mt-4">
                            <x-secondary-link-button href="{{ route('admin.modules.index') }}">
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