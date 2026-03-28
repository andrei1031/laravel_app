<section>
    <header>
        <h2 class="text-2xl font-bold text-white mb-4 tracking-wide">
            {{ __('Update Password') }}
        </h2>

        <p class="text-gray-400 text-sm leading-relaxed">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')"
                class="text-gray-300 uppercase tracking-wider" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full bg-black/30 border-gray-600 text-white placeholder-gray-400 focus:border-orange-400 focus:ring-orange-400 rounded-xl py-3"
                autocomplete="current-password" />
            <x-input-error class="mt-2 text-red-400 text-sm"
                :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')"
                class="text-gray-300 uppercase tracking-wider" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full bg-black/30 border-gray-600 text-white placeholder-gray-400 focus:border-orange-400 focus:ring-orange-400 rounded-xl py-3"
                autocomplete="new-password" />
            <x-input-error class="mt-2 text-red-400 text-sm" :messages="$errors->updatePassword->get('password')" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')"
                class="text-gray-300 uppercase tracking-wider" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full bg-black/30 border-gray-600 text-white placeholder-gray-400 focus:border-orange-400 focus:ring-orange-400 rounded-xl py-3"
                autocomplete="new-password" />
            <x-input-error class="mt-2 text-red-400 text-sm"
                :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-400 hover:to-red-400 px-8 py-3 rounded-xl font-bold shadow-lg">Save</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-400 font-bold">Saved.</p>
            @endif
        </div>
    </form>
</section>