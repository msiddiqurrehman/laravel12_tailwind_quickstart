<section>
    <header>
        <h2 class="text-lg font-medium text-gray-800 dark:text-white/90">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-800 dark:text-white/90">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" 
                            class="" 
                            :value="old('email', $user->email)" 
                            required autofocus autocomplete="username" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" 
                            class="" 
                            :value="old('first_name', $user->first_name)" 
                            required autocomplete="first_name" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" 
                            class="" 
                            :value="old('last_name', $user->last_name)" 
                            required autocomplete="last_name" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="contact_no" :value="__('Contact No')" />
            <x-text-input id="contact_no" name="contact_no" type="text" 
                            class="" 
                            :value="old('contact_no', $user->contact_no)"
                            pattern="[0-9]{10,16}"
                            title="Contact no. format: - 9876543210 or 00919876543210" 
                            required autocomplete="contact_no" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('contact_no')" />
        </div>

        <div>
            <x-input-label for="sec_contact_no" :value="__('Secondary Contact No')" />
            <x-text-input id="sec_contact_no" name="sec_contact_no" type="text" 
                            class="" 
                            :value="old('sec_contact_no', $user->sec_contact_no)" 
                            pattern="[0-9]{10,16}"
                            title="Contact no. format: - 9876543210 or 00919876543210" 
                            autocomplete="sec_contact_no" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('sec_contact_no')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
