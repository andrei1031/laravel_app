<x-app-layout>
    <x-slot name="header">
        <h2 class="f1-title text-5xl font-black text-white tracking-wider">
            Pilot Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-[#0a0a0a]/90 backdrop-blur-xl border border-gray-700/50 rounded-3xl p-8 shadow-2xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <h3 class="f1-title text-3xl font-bold mb-6 text-gray-200 tracking-wider">Personal Telemetry
                        </h3>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    <div>
                        <h3 class="f1-title text-3xl font-bold mb-6 text-gray-200 tracking-wider">Security Systems</h3>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="bg-[#0a0a0a]/90 backdrop-blur-xl border border-red-600/30 rounded-3xl p-8 shadow-2xl">
                <div>
                    <h3 class="f1-title text-3xl font-bold mb-6 text-red-400 tracking-wider">DNF Zone (Delete Account)
                    </h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>