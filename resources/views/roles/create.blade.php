<x-admin-layout>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Add New Role`, pages: [
                                                        {name: `Dashboard`, url: `{{route('admin.dashboard')}}` }, 
                                                        {name: `Role List`, url: `{{route('admin.roles.index')}}` }, 
                                                    ]
                    }">
            <x-breadcrumbs />
        </div>
        <!-- Breadcrumb End -->

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex justify-between px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-theme-xl font-medium text-gray-800 dark:text-white/90">
                        Enter Role Details
                    </h3>
                    <a href="{{ route('admin.roles.index') }}" class="text-theme-lg font-medium text-gray-500 dark:text-white/90">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 inline -mt-0.5">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                        </svg>
                        Cancel
                    </a>
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <form 
                        method="post" 
                        action="{{ route('admin.roles.store') }}" 
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
                            <x-input-label for="title" :value="__('Role Title')"/>

                            <x-text-input
                                type="text"
                                name="title"
                                id="title"
                                placeholder="Role Title"
                                value="{{ old('title', '') }}"
                            />
                            
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- ====== Table Start -->
                        <div class="mb-5 overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                            
                            <x-input-label :value="__('Role Permissions')"/>

                            @can('create', App\Models\Permission::class)
                                <div class="max-w-full overflow-x-auto">
                                    <table class="min-w-full">
                                        <!-- table header start -->
                                        <thead>
                                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                            Module
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                            View
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                            Create
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                            Edit
                                                        </p>
                                                    </div>
                                                </th>
                                                <th class="px-5 py-3 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                            Delete
                                                        </p>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <!-- table header end -->
                                        <!-- table body start -->
                                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                            @foreach ($modules as $module)
                                            <tr>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <span class="text-gray-600 dark:text-gray-400">
                                                        {{ $module->name }}
                                                    </span>
                                                    <input type="hidden" name="{{ 'permissions['.$module->id.'][module_id]' }}" 
                                                            value="{{ $module->id }}"/>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    @php
                                                        $permission_name = "permissions[".$module->id."][can_view]";
                                                        $permission_name_for_old = "permissions.".$module->id.".can_view";
                                                    @endphp
                                                    <x-toggle-switch 
                                                        name="{{ $permission_name }}"
                                                        id="{{ $permission_name_for_old }}" 
                                                        label="" 
                                                        checked="{{ (bool)old($permission_name_for_old) }}"
                                                    />
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    @php
                                                        $permission_name = "permissions[".$module->id."][can_create]";
                                                        $permission_name_for_old = "permissions.".$module->id.".can_create";
                                                    @endphp
                                                    <x-toggle-switch 
                                                        name="{{ $permission_name }}"
                                                        id="{{ $permission_name_for_old }}" 
                                                        label="" 
                                                        checked="{{ (bool)old($permission_name_for_old) }}"
                                                    />
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    @php
                                                        $permission_name = "permissions[".$module->id."][can_edit]";
                                                        $permission_name_for_old = "permissions.".$module->id.".can_edit";
                                                    @endphp
                                                    <x-toggle-switch 
                                                        name="{{ $permission_name }}"
                                                        id="{{ $permission_name_for_old }}" 
                                                        label="" 
                                                        checked="{{ (bool)old($permission_name_for_old) }}"
                                                    />
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    @php
                                                        $permission_name = "permissions[".$module->id."][can_delete]";
                                                        $permission_name_for_old = "permissions.".$module->id.".can_delete";
                                                    @endphp
                                                    <x-toggle-switch 
                                                        name="{{ $permission_name }}"
                                                        id="{{ $permission_name_for_old }}" 
                                                        label="" 
                                                        checked="{{ (bool)old($permission_name_for_old) }}"
                                                    />
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <span class="text-red-500">
                                    You are not allowed to add permissions.
                                </span>
                            @endcan
                        </div>
                        <!-- ====== Table End -->

                        <div class="flex items-center justify-start mt-4">
                            <x-secondary-link-button href="{{ route('admin.roles.index') }}">
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