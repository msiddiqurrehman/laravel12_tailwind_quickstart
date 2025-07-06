<x-admin-layout>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{
            pageName: `Add New User`,
            pages: [
                { name: `Dashboard`, url: `{{ route('admin.dashboard') }}` },
                { name: `User List`, url: `{{ route('admin.users.index') }}` },
            ]
        }">
            <x-breadcrumbs />
        </div>
        <!-- Breadcrumb End -->

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex justify-between px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-theme-xl font-medium text-gray-800 dark:text-white/90">
                        Enter User Details
                    </h3>
                    <a href="{{ route('admin.users.index') }}"
                        class="text-theme-lg font-medium text-gray-500 dark:text-white/90">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="size-5 inline -mt-0.5">
                            <path
                                d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                        </svg>
                        Cancel
                    </a>
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <form 
                        method="post" 
                        action="{{ route('admin.users.store') }}" 
                        enctype="multipart/form-data"
                        class="space-y-6"
                        x-data = "{ selectedUserType: '{{ old('user_type_id', '') }}' }"
                    >
                        @csrf

                        <x-toggle-switch name="status" id="status" label="Status"
                            checked="{{ (bool) old('status') }}" />

                        <div>
                            <x-input-label for="user_type_id" :value="__('User Type')" />

                            <x-select-input id="user_type_id" name="user_type_id" x-model="selectedUserType">

                                <x-select-option value="" text="Select User Type"/>

                                @foreach ($usertypes as $usertype)
                                    <x-select-option 
                                                    value="{{ $usertype->id }}" 
                                                    text="{{ $usertype->type }}" 
                                                    :is-selected="old('user_type_id') == $usertype->id" 
                                    />
                                @endforeach

                            </x-select-input>

                            <x-input-error class="mt-2" :messages="$errors->get('user_type_id')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input type="email" name="email" id="email" placeholder="Email"
                                value="{{ old('email', '') }}" />

                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')" />

                            <x-password-input name="password" id="password" placeholder="Password"
                                value="{{ old('password', '') }}" />

                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />

                            <x-text-input type="text" name="first_name" id="first_name" placeholder="First Name"
                                value="{{ old('first_name', '') }}" />

                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                        </div>

                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" />

                            <x-text-input type="text" name="last_name" id="last_name" placeholder="Last Name"
                                value="{{ old('last_name', '') }}" />

                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                        </div>

                        <div x-show="selectedUserType == 1">
                            <x-input-label for="designation_id" :value="__('Designation')" />

                            <x-select-input id="designation_id" name="designation_id" ::disabled="selectedUserType != 1">

                                <x-select-option value="" text="Select Designation" />

                                @foreach ($designations as $designation)
                                    <x-select-option 
                                                    value="{{ $designation->id }}" 
                                                    text="{{ $designation->title }}"
                                                    :is-selected="old('designation_id') == $designation->id"
                                    />
                                @endforeach

                            </x-select-input>

                            <x-input-error class="mt-2" :messages="$errors->get('user_type_id')" />
                        </div>

                        <div>
                            <x-input-label for="contact_no" :value="__('Contact No')" />

                            <x-text-input id="contact_no" name="contact_no" type="text" class=""
                                :value="old('contact_no', '')" pattern="[0-9]{10,16}"
                                title="Contact no. format: - 9876543210 or 00919876543210" required
                                autocomplete="contact_no" />

                            <x-input-error class="mt-2" :messages="$errors->get('contact_no')" />
                        </div>

                        <div>
                            <x-input-label for="sec_contact_no" :value="__('Secondary Contact No')" />

                            <x-text-input id="sec_contact_no" name="sec_contact_no" type="text" class=""
                                :value="old('sec_contact_no', '')" pattern="[0-9]{10,16}"
                                title="Contact no. format: - 9876543210 or 00919876543210"
                                autocomplete="sec_contact_no" />

                            <x-input-error class="mt-2" :messages="$errors->get('sec_contact_no')" />
                        </div>

                        <div>
                            <x-image-upload name="user_image" label="Choose Image" />
                        </div>

                        <div>
                            <x-input-label :value="__('Choose User Roles')" />

                            <div class="flex flex-wrap items-center gap-8 mt-1">
                                @foreach ($roles as $role)
                                    <x-checkbox-input id="{{ 'chk-user-role_'.$role->id }}" name="user_role_ids[]" label="{{ $role->title }}" value="{{ $role->id }}" />
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-start mt-4">
                            <x-secondary-link-button href="{{ route('admin.users.index') }}">
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
