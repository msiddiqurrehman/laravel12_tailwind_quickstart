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
                    >
                        @csrf

                        <x-toggle-switch name="status" id="status" label="Status"
                            checked="{{ (bool) old('status') }}" />

                        <div>
                            <x-input-label for="user_type_id" :value="__('User Type')" />

                            <x-select-input id="user_type_id" name="user_type_id">

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

                        <div>
                            <x-input-label for="designation_id" :value="__('Designation')" />

                            <x-select-input id="designation_id" name="designation_id">

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

                        <!-- Image upload -->
                        <div  x-data="{ images: [] }">
                            <!-- icons -->
                            <div class="icons mt-10">
                                <label class="cursor-pointer flex mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400" id="select-image">
                                    <span>Choose Image</span>
                                    <svg class="ms-2 mr-2 hover:text-gray-700 border rounded-full p-1 h-7"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                    <input type="file" name="user_image" hidden
                                        @change="images = Array.from($event.target.files).map(file => ({url: URL.createObjectURL(file), name: file.name, preview: ['jpg', 'jpeg', 'png', 'gif'].includes(file.name.split('.').pop().toLowerCase()), size: file.size > 1024 ? file.size > 1048576 ? Math.round(file.size / 1048576) + 'mb' : Math.round(file.size / 1024) + 'kb' : file.size + 'b'}))"
                                        x-ref="fileInput">

                                </label>
                            </div>

                            <!-- Preview image here -->
                            <div id="preview" class="flex">
                                <template x-for="(image, index) in images" :key="index">
                                    <div class="relative w-32 h-32 my-4 object-cover rounded ">
                                        <div x-show="image.preview" class="relative w-32 h-32 object-cover rounded">
                                            <img :src="image.url" class="w-32 h-32 object-cover rounded">
                                            <button @click="images.splice(index, 1)"
                                                class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span
                                                    class="mx-auto">×</span></button>
                                            <div x-text="image.size" class="text-xs text-center p-2"></div>
                                        </div>
                                        <div x-show="!image.preview" class="relative w-32 h-32 object-cover rounded">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-white stroke-indigo-500" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg> -->
                                            <svg class="fill-current  w-32 h-32 ml-auto pt-1"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                                            </svg>
                                            <button @click="images.splice(index, 1)"
                                                class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span
                                                    class="mx-auto">×</span></button>
                                            <div x-text="image.size" class="text-xs text-center p-2"></div>
                                        </div>

                                    </div>
                                </template>
                            </div>
                        </div>
                        <!-- Image upload -->

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
