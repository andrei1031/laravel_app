<section>
    <header>
        <h2 class="text-2xl font-bold text-white mb-4 tracking-wide">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-gray-400 text-sm leading-relaxed">
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
            <x-input-label for="name" :value="__('Name')" class="text-gray-300 uppercase tracking-wider" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full bg-black/30 border-gray-600 text-white placeholder-gray-400 focus:border-orange-400 focus:ring-orange-400 rounded-xl py-3"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />

            <x-input-error class="mt-2 text-red-400 text-sm" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300 uppercase tracking-wider" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full bg-black/30 border-gray-600 text-white placeholder-gray-400 focus:border-orange-400 focus:ring-orange-400 rounded-xl py-3"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-400 text-sm" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-orange-500/20 border border-orange-400/30 rounded-xl">
                    <p class="text-sm text-orange-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-orange-100 hover:text-white ml-1">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-emerald-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-400 hover:to-red-400 px-8 py-3 rounded-xl font-bold shadow-lg">Save</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-400 font-bold">Saved.</p>
            @endif
        </div>
    </form>
</section>