<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="grid grid-cols-2 gap-5 w-full">
        <div class="w-1/2">
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6"
                  enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="name" :value="__('Name')"/>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                  :value="old('name', $user->name)" required autofocus autocomplete="name"/>
                    <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                  :value="old('email', $user->email)" required autocomplete="email"/>
                    <x-input-error class="mt-2" :messages="$errors->get('email')"/>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification"
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
                    <x-input-label for="height" :value="__('Height')"/>
                    <x-text-input id="height" name="height" type="number" class="mt-1 block w-full"
                                  :value="old('height', $user->userInformation->height)" required autofocus
                                  autocomplete="height"/>
                    <x-input-error class="mt-2" :messages="$errors->get('height')"/>
                </div>
                <div>
                    <x-input-label for="weight" :value="__('Weight')"/>
                    <x-text-input id="weight" name="weight" type="number" class="mt-1 block w-full"
                                  :value="old('weight', $user->userInformation->weight)" required autofocus
                                  autocomplete="weight"/>
                    <x-input-error class="mt-2" :messages="$errors->get('weight')"/>
                </div>
                <div>
                    <x-input-label for="avatar" :value="__('Profile picture')"/>
                    <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full"
                                  :value="old('avatar', $user->userInformation->avatar)" required autofocus
                                  autocomplete="avatar"/>
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')"/>
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
        </div>
        <div>
            @if(!empty($user->userInformation->avatar))
                <img src="{{ $user->userInformation->avatar }}" alt="User profile picture"/>
            @endif
        </div>
    </div>
</section>
