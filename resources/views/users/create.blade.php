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
                        <div  class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="p-5 space-y-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                    General Details
                                </h3>

                                <!-- Status -->
                                <x-toggle-switch name="status" id="status" label="Status"
                                    checked="{{ (bool) old('status') }}" 
                                />

                                <!-- User Type -->
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

                                <!-- Email -->
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />

                                    <x-text-input type="email" name="email" id="email" placeholder="Email"
                                        value="{{ old('email', '') }}" />

                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <!-- Password -->
                                <div>
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-password-input name="password" id="password" placeholder="Password"
                                        value="{{ old('password', '') }}" />

                                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                </div>

                                <!-- First Name -->
                                <div>
                                    <x-input-label for="first_name" :value="__('First Name')" />

                                    <x-text-input type="text" name="first_name" id="first_name" placeholder="First Name"
                                        value="{{ old('first_name', '') }}" />

                                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <x-input-label for="last_name" :value="__('Last Name')" />

                                    <x-text-input type="text" name="last_name" id="last_name" placeholder="Last Name"
                                        value="{{ old('last_name', '') }}" />

                                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                </div>

                                <!-- Gender -->
                                <div>
                                    <x-input-label for="gender" :value="__('Gender')" />

                                    <x-select-input id="gender" name="gender">

                                        <x-select-option value="" text="Select Gender"/>
                                        <x-select-option value="female" text="Female" :is-selected="old('gender') == 'female'" />
                                        <x-select-option value="male" text="Male" :is-selected="old('gender') == 'male'" />

                                    </x-select-input>

                                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                                </div>

                                <!-- Contact No -->
                                <div>
                                    <x-input-label for="contact_no" :value="__('Contact No')" />

                                    <x-text-input id="contact_no" name="contact_no" type="text" class=""
                                        :value="old('contact_no', '')" placeholder="9876543210 / 00919876543210" pattern="[0-9]{10,16}"
                                        title="Contact no. format: - 9876543210 or 00919876543210" required />

                                    <x-input-error class="mt-2" :messages="$errors->get('contact_no')" />
                                </div>

                                <!-- Sec Contact No -->
                                <div>
                                    <x-input-label for="sec_contact_no" :value="__('Secondary Contact No')" />

                                    <x-text-input id="sec_contact_no" name="sec_contact_no" type="text" class=""
                                        :value="old('sec_contact_no', '')" placeholder="9876543210 / 00919876543210" pattern="[0-9]{10,16}"
                                        title="Contact no. format: - 9876543210 or 00919876543210" />

                                    <x-input-error class="mt-2" :messages="$errors->get('sec_contact_no')" />
                                </div>

                                <!-- Address -->
                                <div>
                                    <x-input-label for="address" :value="__('Address')" />

                                    <x-text-input type="text" name="address" id="address" placeholder="H. No., Floor, Apartment, Street, Area"
                                        value="{{ old('address', '') }}" />

                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>

                                <!-- City -->
                                <div>
                                    <x-input-label for="city" :value="__('City/Village')" />

                                    <x-text-input type="text" name="city" id="city" placeholder="City / Village Name"
                                        value="{{ old('city', '') }}" />

                                    <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                </div>

                                <!-- District -->
                                <div>
                                    <x-input-label for="district" :value="__('District')" />

                                    <x-text-input type="text" name="district" id="district" placeholder="District Name"
                                        value="{{ old('district', '') }}" />

                                    <x-input-error class="mt-2" :messages="$errors->get('district')" />
                                </div>

                                <!-- State -->
                                <div>
                                    <x-input-label for="state_id" :value="__('State')" />

                                    <x-select-input id="state_id" name="state_id">

                                        <x-select-option value="" text="Select State"/>

                                        @foreach ($states as $state)
                                            <x-select-option 
                                                            value="{{ $state->id }}" 
                                                            text="{!! $state->name !!}" 
                                                            :is-selected="old('state_id') == $state->id" 
                                            />
                                        @endforeach

                                    </x-select-input>

                                    <x-input-error class="mt-2" :messages="$errors->get('state_id')" />
                                </div>

                                <!-- Country -->
                                <div>
                                    <x-input-label for="country_id" :value="__('Country')" />

                                    <x-select-input id="country_id" name="country_id">

                                        <x-select-option value="" text="Select Country"/>

                                        @foreach ($countries as $country)
                                            <x-select-option 
                                                            value="{{ $country->id }}" 
                                                            text="{{ $country->name }}" 
                                                            :is-selected="old('country_id') == $country->id" 
                                            />
                                        @endforeach

                                    </x-select-input>

                                    <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
                                </div>

                                <!-- User Image -->
                                <div>
                                    <x-image-upload name="user_image" label="Choose Image" />
                                </div>

                                <!-- Roles -->
                                <div>
                                    <x-input-label :value="__('Choose User Roles')" />

                                    <div class="flex flex-wrap items-center gap-8 mt-1">
                                        @foreach ($roles as $role)
                                            @php
                                                $isChecked = in_array($role->id, old('user_role_ids', [])) ? 'true' : 'false';
                                            @endphp
                                            <x-checkbox-input id="{{ 'chk-user-role_'.$role->id }}" name="user_role_ids[]" label="{{ $role->title }}" value="{{ $role->id }}" :is-checked="$isChecked"/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="p-5 space-y-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                <h3 class="mb-17.5 text-base font-medium text-gray-800 dark:text-white/90">
                                    User Type Specific Details
                                </h3>

                                @can('create', App\Models\EmpDetail::class)
                                    <div id="user_type_staff_fields" x-show="selectedUserType == 1">
                                        <!-- Designation -->
                                        <div>
                                            <x-input-label for="designation_id" :value="__('Designation')" />

                                            <x-select-input id="designation_id" name="emp_detail[designation_id]" ::disabled="selectedUserType != 1">

                                                <x-select-option value="" text="Select Designation" />

                                                @foreach ($designations as $designation)
                                                    <x-select-option 
                                                                    value="{{ $designation->id }}" 
                                                                    text="{{ $designation->title }}"
                                                                    :is-selected="old('emp_detail.designation_id') == $designation->id"
                                                    />
                                                @endforeach

                                            </x-select-input>

                                            <x-input-error class="mt-2" :messages="$errors->get('emp_detail.designation_id')" />
                                        </div>

                                        <!-- Referrer Name -->
                                        <div>
                                            <x-input-label for="referrer_name" :value="__('Referrer Name')" />

                                            <x-text-input type="text" name="emp_detail[referrer_name]" id="referrer_name" placeholder="Referrer Name"
                                                value="{{ old('emp_detail.referrer_name', '') }}" ::disabled="selectedUserType != 1"/>

                                            <x-input-error class="mt-2" :messages="$errors->get('emp_detail.referrer_name')" />
                                        </div>

                                        <!-- Referrer Contact -->
                                        <div>
                                            <x-input-label for="referrer_contact" :value="__('Referrer Contact')" />

                                            <x-text-input id="referrer_contact" name="emp_detail[referrer_contact]" type="text" placeholder="Referrer Contact"
                                                :value="old('emp_detail.referrer_contact', '')" pattern="[0-9]{10,16}"
                                                title="Contact no. format: - 9876543210 or 00919876543210" ::disabled="selectedUserType != 1"/>

                                            <x-input-error class="mt-2" :messages="$errors->get('emp_detail.referrer_contact')" />
                                        </div>

                                        <!-- Identity Doc Image -->
                                        <div class="max-w-[265px]">
                                            <x-image-upload name="emp_detail[identity_document]" label="Choose Identity Document Image" ::disabled="selectedUserType != 1"/>
                                        </div>

                                        <!-- Education Doc Image -->
                                        <div class="max-w-[275px]">
                                            <x-image-upload name="emp_detail[education_document]" label="Choose Education Document Image" ::disabled="selectedUserType != 1"/>
                                        </div>

                                        <!-- Resume -->
                                        <div class="max-w-36.5">
                                            <x-image-upload name="emp_detail[resume]" label="Choose Resume (PDF)" fileAccept="application/pdf, .doc, .docx" ::isImageUpload="false" ::disabled="selectedUserType != 1"/>
                                        </div>
                                    </div>
                                @else
                                    <div id="user_type_staff_fields" x-show="selectedUserType == 1">
                                        <span class="text-red-500">
                                            You are not allowed to add employee details.
                                        </span>
                                    </div>
                                @endcan

                                <div id="user_type_partner_fields" x-show="selectedUserType == 2">
                                    <div class="dark:text-white/90">Partner details fields will go here...</div>
                                </div>

                                <div id="user_type_customer_fields" x-show="selectedUserType == 3">
                                    <div class="dark:text-white/90">Customer details fields will go here...</div>
                                </div>
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
