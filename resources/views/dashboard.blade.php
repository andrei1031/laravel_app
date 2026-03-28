<x-app-layout>
    <x-slot name="header">
        <h2
            class="f1-title text-5xl font-black text-red-400 drop-shadow-[0_0_20px_rgba(220,38,38,0.8)] tracking-wider leading-tight !important">
            F1 RANKER DASHBOARD
        </h2>
    </x-slot>

    <div class="pt-8 pb-32 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto relative z-10 flex flex-col gap-10">
        <!-- Hero -->
        <div class="border-b border-gray-800 pb-6 flex justify-between items-end">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="w-3 h-3 rounded-full bg-red-600 animate-pulse shadow-[0_0_12px_#dc2626]"></span>
                    <span class="text-red-500 font-bold tracking-[0.3em] text-sm uppercase">Premium Control
                        Center</span>
                </div>
                <h1
                    class="f1-title text-6xl md:text-8xl font-black text-red-400 drop-shadow-[0_0_30px_rgba(220,38,38,1)] leading-none tracking-wide mt-2 !important">
                    Welcome <span class="text-white drop-shadow-2xl">{{ Auth::user()->name }}</span>
                </h1>
                <p class="text-gray-400 text-lg font-medium tracking-[0.1em] uppercase pb-2">Drag to rank liveries •
                    Telemetry predictions auto-saved • 2026 Grid ready</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('rankings.index') }}"
                    class="px-8 py-4 bg-gradient-to-r from-red-600 to-red-800 hover:from-red-500 hover:to-red-700 text-white font-bold rounded-2xl text-xl uppercase tracking-wide shadow-2xl hover:shadow-red-500/50 transform hover:scale-105 transition-all duration-300 border-0">
                    RANK NOW
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="px-6 py-4 bg-black/50 hover:bg-gray-800 border border-gray-700 text-gray-300 hover:text-white font-bold rounded-xl text-sm uppercase tracking-wide shadow-lg hover:shadow-xl transition-all duration-300">
                    Profile
                </a>
            </div>
        </div>

        <!-- Quick Stats - F1 Cards -->
        <div class="flex flex-col gap-6">
            <h3 class="f1-title text-3xl font-black text-red-400 drop-shadow-lg tracking-wide uppercase">Quick Stats
            </h3>
            <div class="grid md:grid-cols-3 gap-6">
                <li class="f1-card relative border border-gray-800 rounded-2xl p-8 text-center hover:-translate-y-1 transition-all duration-300 cursor-default"
                    style="--team-color: #E2001A; border-left-width: 6px; border-left-color: #E2001A;">
                    <div class="f1-card-inner">
                        <div class="text-5xl font-black text-red-400 mb-4 f1-title drop-shadow-lg">11</div>
                        <h4 class="text-xl font-bold text-white uppercase tracking-wider mb-1">Teams</h4>
                        <p class="text-gray-400 text-sm uppercase tracking-widest">2026 Grid Complete</p>
                    </div>
                </li>
                <li class="f1-card relative border border-gray-800 rounded-2xl p-8 text-center hover:-translate-y-1 transition-all duration-300 cursor-default"
                    style="--team-color: #FF8000; border-left-width: 6px; border-left-color: #FF8000;">
                    <div class="f1-card-inner">
                        <div class="text-5xl font-black text-orange-400 mb-4 f1-title drop-shadow-lg">22</div>
                        <h4 class="text-xl font-bold text-white uppercase tracking-wider mb-1">Drivers</h4>
                        <p class="text-gray-400 text-sm uppercase tracking-widest">Full Lineup Loaded</p>
                    </div>
                </li>
                <li class="f1-card relative border border-gray-800 rounded-2xl p-8 text-center hover:-translate-y-1 transition-all duration-300 cursor-default"
                    style="--team-color: #3671C6; border-left-width: 6px; border-left-color: #3671C6;">
                    <div class="f1-card-inner">
                        <div class="text-5xl font-black text-blue-400 mb-4 f1-title drop-shadow-lg">SYNCED</div>
                        <h4 class="text-xl font-bold text-white uppercase tracking-wider mb-1">Rankings</h4>
                        <p class="text-gray-400 text-sm uppercase tracking-widest">Auto-Save Active</p>
                    </div>
                </li>
            </div>
        </div>

        <!-- Premium News Feed -->
        <div class="flex flex-col gap-6">
            <h3 class="f1-title text-3xl font-black text-red-400 drop-shadow-lg tracking-wide uppercase">F1 Telemetry
                Feed</h3>
            <li class="f1-card relative border border-gray-800 rounded-2xl p-12 hover:-translate-y-1 transition-all duration-300"
                style="--team-color: #dc2626; border-left-width: 6px; border-left-color: #dc2626;">
                <div class="f1-card-inner">
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <div>
                            <div class="flex gap-3 mb-4">
                                <span
                                    class="w-3 h-3 rounded-full bg-red-500 animate-pulse shadow-[0_0_12px_#dc2626]"></span>
                                <span class="text-red-400 font-bold tracking-[0.2em] uppercase">HOT NEWS</span>
                            </div>
                            <h4 class="text-3xl font-bold text-white tracking-wider uppercase mb-4">Hamilton to Ferrari
                            </h4>
                            <p class="text-gray-300 text-lg leading-relaxed mb-6">7x Champion signs historic deal. 2026
                                grid shake-up begins.</p>
                            <a href="#"
                                class="inline-flex items-center gap-2 text-red-400 hover:text-red-300 font-bold uppercase text-sm tracking-wide">
                                Read More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-black/40 border border-gray-700 rounded-xl p-4 text-center">
                                <div class="text-2xl font-black text-orange-400 f1-title">7x</div>
                                <p class="text-gray-400 text-xs uppercase tracking-wider">CHAMPIONSHIPS</p>
                            </div>
                            <div class="bg-black/40 border border-gray-700 rounded-xl p-4 text-center">
                                <div class="text-2xl font-black text-emerald-400 f1-title">105+</div>
                                <p class="text-gray-400 text-xs uppercase tracking-wider">WINS</p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </div>
    </div>
</x-app-layout>