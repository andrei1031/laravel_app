<x-guest-layout>
    <div class="f1-bg fixed inset-0 pointer-events-none z-0"></div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0"
            style="background: radial-gradient(circle at 50% -10%, rgba(226, 0, 26, 0.15) 0%, transparent 70%);"></div>

        <div class="max-w-lg w-full space-y-8 relative z-20">
            <!-- F1 Logo -->
            <div class="text-center">
                <div
                    class="mx-auto h-28 w-28 flex items-center justify-center bg-gradient-to-br from-red-600 to-red-800 rounded-3xl mb-8 shadow-2xl border-4 border-red-400/50 backdrop-blur-xl">
                    <svg class="h-16 w-16 text-white drop-shadow-2xl" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="f1-title text-5xl md:text-6xl font-black text-white tracking-widest mb-2 drop-shadow-2xl">
                    JOIN F1 RANKER
                </h2>
                <p class="text-gray-300 text-lg font-medium tracking-widest uppercase">Create your racer profile</p>
            </div>

            <form
                class="space-y-6 bg-[#0d0d0d]/95 backdrop-blur-xl py-12 px-8 shadow-2xl rounded-3xl border border-gray-700/50 max-w-2xl mx-auto"
                action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name"
                        class="block text-lg font-bold text-gray-300 mb-4 tracking-wider uppercase flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded-full animate-ping shadow-lg"></span>
                        Display Name
                    </label>
                    <x-text-input id="name" name="name" type="text" autocomplete="name" required
                        class="w-full h-16 rounded-2xl px-6 py-4 text-lg border-2 border-gray-600/50 bg-black/30 backdrop-blur-sm text-white placeholder-gray-400 focus:border-red-500 focus:ring-4 ring-red-500/30 transition-all duration-300 shadow-xl hover:shadow-red-500/20 hover:border-red-400"
                        :value="old('name')" placeholder="Your F1 racer name" autofocus />
                    <x-input-error class="mt-2 text-sm text-red-400 font-bold" :messages="$errors->get('name')" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-lg font-bold text-gray-300 mb-4 tracking-wider uppercase flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded-full animate-ping shadow-lg"></span>
                        Driver Email
                    </label>
                    <x-text-input id="email" name="email" type="email" autocomplete="email" required
                        class="w-full h-16 rounded-2xl px-6 py-4 text-lg border-2 border-gray-600/50 bg-black/30 backdrop-blur-sm text-white placeholder-gray-400 focus:border-red-500 focus:ring-4 ring-red-500/30 transition-all duration-300 shadow-xl hover:shadow-red-500/20 hover:border-red-400"
                        :value="old('email')" placeholder="racer@f1ranker.com" />
                    <x-input-error class="mt-2 text-sm text-red-400 font-bold" :messages="$errors->get('email')" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password"
                        class="block text-lg font-bold text-gray-300 mb-4 tracking-wider uppercase flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded-full animate-ping shadow-lg"></span>
                        Security Code
                    </label>
                    <x-text-input id="password" name="password" type="password" autocomplete="new-password" required
                        class="w-full h-16 rounded-2xl px-6 py-4 text-lg border-2 border-gray-600/50 bg-black/30 backdrop-blur-sm text-white placeholder-gray-400 focus:border-red-500 focus:ring-4 ring-red-500/30 transition-all duration-300 shadow-xl hover:shadow-red-500/20 hover:border-red-400"
                        placeholder="Create secure code (min 8 chars)" />
                    <x-input-error class="mt-2 text-sm text-red-400 font-bold" :messages="$errors->get('password')" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation"
                        class="block text-lg font-bold text-gray-300 mb-4 tracking-wider uppercase flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded-full animate-ping shadow-lg"></span>
                        Confirm Code
                    </label>
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password" required
                        class="w-full h-16 rounded-2xl px-6 py-4 text-lg border-2 border-gray-600/50 bg-black/30 backdrop-blur-sm text-white placeholder-gray-400 focus:border-red-500 focus:ring-4 ring-red-500/30 transition-all duration-300 shadow-xl hover:shadow-red-500/20 hover:border-red-400"
                        placeholder="Confirm security code" />
                    <x-input-error class="mt-2 text-sm text-red-400 font-bold"
                        :messages="$errors->get('password_confirmation')" />
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-6 px-8 border-2 border-red-500 text-xl font-bold rounded-2xl text-white bg-gradient-to-r from-red-600 to-red-800 hover:from-red-500 hover:to-red-700 focus:outline-none focus:ring-4 ring-red-400/50 shadow-2xl hover:shadow-red-500/50 transform hover:-translate-y-1 hover:scale-[1.02] transition-all duration-300 uppercase tracking-wider font-black">
                        <span class="absolute left-4 inset-y-0 flex items-center">
                            <svg class="h-6 w-6 text-red-200 group-hover:text-white transition-colors" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-14" />
                            </svg>
                        </span>
                        <span>JOIN THE GRID</span>
                    </button>
                </div>

                <div class="text-center py-4">
                    <p class="text-sm text-gray-400">
                        Already registered? <a href="{{ route('login') }}"
                            class="font-bold text-red-400 hover:text-red-300 uppercase tracking-wider">Sign In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>