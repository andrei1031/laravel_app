<x-app-layout>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        body, html, .min-h-screen, .bg-gray-100 {
            background-color: #050505 !important; 
            font-family: 'Rajdhani', sans-serif !important;
            color: #ffffff !important;
        }
        
        nav.bg-white { 
            background-color: #0a0a0a !important; 
            border-bottom: 1px solid #222 !important; 
        }
        nav .text-gray-500, nav .text-gray-800 { color: #e5e5e5 !important; }
        header.bg-white { display: none !important; } 

        .f1-bg {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        .f1-bg::after {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 50% -10%, rgba(226, 0, 26, 0.15) 0%, transparent 70%);
        }

        .f1-title { font-family: 'Teko', sans-serif; }
        
        .f1-card {
            background: linear-gradient(90deg, rgba(20,20,20,0.95) 0%, rgba(5,5,5,0.95) 100%);
            border: 1px solid rgba(255,255,255,0.05); transform: skewX(-4deg); transition: all 0.2s ease-out;
        }
        
        .f1-card-inner { transform: skewX(4deg); }
        .f1-card:hover { border-color: var(--team-color); }

        .rank-number {
            font-family: 'Teko', sans-serif; font-size: 4rem; line-height: 0.8;
            background: linear-gradient(180deg, #ffffff 0%, #333333 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; opacity: 0.8;
        }

        .sortable-ghost { opacity: 0.2; filter: grayscale(100%); }
        .sortable-drag {
            box-shadow: -20px 20px 50px rgba(0,0,0,0.9), -5px 0 25px var(--team-color) !important;
            transform: skewX(-4deg) scale(1.06) rotate(-2deg) !important; cursor: grabbing !important;
        }
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #050505; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #E2001A; }

        .modal-open { animation: modalIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .modal-close { animation: modalOut 0.2s ease-in forwards; }
        @keyframes modalIn { from { opacity: 0; transform: scale(0.95) translateY(10px); } to { opacity: 1; transform: scale(1) translateY(0); } }
        @keyframes modalOut { from { opacity: 1; transform: scale(1) translateY(0); } to { opacity: 0; transform: scale(0.95) translateY(10px); } }
'a  @endphp

    <div class="f1-bg" style="z-index: 0;"></div>

    <div class="pt-8 pb-32 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto relative z-40 flex flex-col gap-10">
        
        <div class="border-b border-gray-800 pb-6 flex justify-between items-end">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="w-3 h-3 rounded-full bg-red-600 animate-pulse shadow-[0_0_12px_#dc2626]"></span>
                    <span class="text-red-500 font-bold tracking-[0.3em] text-sm uppercase">2026 Grid Configuration</span>
                </div>
                <h1 class="f1-title text-6xl md:text-8xl font-black text-white leading-none tracking-wide mt-2 !important">
                    LIVERY <span class="text-red-500 drop-shadow-[0_0_20px_rgba(220,38,38,0.8)] !important">RANKER</span>
                </h1>
                <p class="text-gray-400 text-lg font-medium tracking-[0.1em] uppercase pb-2">Click card for driver data // Drag to auto-save telemetry predictions</p>
            </div>
            
            <div id="auto-save-toast" class="hidden flex items-center gap-3 bg-black/80 border border-gray-700 px-4 py-2 rounded-lg backdrop-blur-md shadow-lg transition-all duration-300">
                <div id="save-spinner" class="hidden">
                    <svg class="animate-spin h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>
                <div id="save-check" class="hidden text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span id="save-text" class="f1-title text-xl tracking-widest text-gray-300 mt-1">SYNCING...</span>
            </div>
        </div>

<div class="flex flex-col gap-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="f1-title text-4xl font-black tracking-widest">YOUR 2026 GRID PREDICTION</h2>
                <div class="flex gap-3">
                    <button id="reset-grid" class="px-6 py-2 bg-gray-800/50 hover:bg-red-600/70 border border-gray-600 text-white font-bold rounded-xl transition-all duration-200 text-sm uppercase tracking-wide flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-.43M15.5 19H9"/></svg>
                        Reset Grid
                    </button>
                </div>
    </div>
            <ul id="sortable-list" class="space-y-4 flex flex-col" style="counter-reset: rank-counter;">
                @forelse($teams as $team)
                    @php $color = $teamColors[$team->name] ?? '#888888'; @endphp
                    
                    <li data-id="{{ $team->id }}" 
                        onclick="openDriverModal('{{ addslashes($team->name) }}', '{{ $color }}')"
                        class="f1-card relative border border-gray-800 rounded-2xl cursor-pointer p-4 overflow-hidden flex items-center transition-all hover:-translate-y-0.5"
                        style="--team-color: {{ $color }}; border-left-width: 6px; border-left-color: {{ $color }};"
                    >
                        <div class="flex-grow flex items-center gap-4 md:gap-6 f1-card-inner">
                            <div class="w-12 md:w-16 flex justify-center items-center">
                                <span class="rank-number before:content-[counter(rank-counter)]" style="counter-increment: rank-counter;"></span>
                            </div>

                            <div class="w-28 h-16 md:w-32 md:h-20 bg-black/50 border border-grayms-center justify-center shadow-inner relative transition-colors group-hover:border-[var(--team-color)]/50">
@if($team->livery_image_path && file_exists(public_path('storage/' . $team->livery_image_path)))
                                    <img src="{{ asset('storage/' . $team->livery_image_path) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-10 h-10 text-gray-700 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="absolute bottom-1 right-2 text-[10px] text-gray-700 font-bold tracking-widest uppercase">Awaiting Livery</span>
                                @endif
                            </div>
                            
                            <div class="flex-grow">
<h3 class="f1-title text-3xl md:text-4xl text-white tracking-widest uppercase leading-none group-hover:text-white transition-colors" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5);">{{ $team->name }}</h3>
                                <div class="flex items-center gap-2 mt-1 md:mt-2">
                                    <span class="w-2 h-2 rounded-full" style="background-color: {{ $color }}; box-shadow: 0 0 8px {{ $color }};"></span>
                                    <p class="text-xs md:text-sm text-gray-400 font-semibold tracking-[0.15em] uppercase">
                                        {{ $team->drivers->pluck('name')->join(' // ') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-500 hover:text-white transition-colors cursor-grab drag-handle relative z-30 ml-4 p-2" onclick="event.stopPropagation()">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                        </div>
                    </li>
                @empty
                    <li class="text-center py-20 text-gray-500">
                        <p class="text-xl">No teams yet. Seed data first.</p>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

    <div id="driver-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden">
        <div class="absolute inset-0 bg-black/90 backdrop-blur-md cursor-pointer" onclick="closeDriverModal()"></div>
        
        <div id="modal-box" class="relative bg-[#0d0d0d] border border-gray-700 w-full max-w-5xl rounded-3xl shadow-[0_0_80px_rgba(0,0,0,1)] overflow-hidden">
            
            <div id="modal-header" class="px-8 py-5 border-b border-gray-800 flex justify-between items-center bg-[#050505]" style="border-top-width: 6px; border-top-color: #fff;">
                <h2 id="modal-team-name" class="f1-title text-5xl text-white tracking-widest uppercase m-0 leading-none">TEAM NAME</h2>
                <button onclick="closeDriverModal()" class="text-gray-500 hover:text-white transition-colors relative z-[110]">
                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="p-4 md:p-8 bg-gradient-to-b from-[#0a0a0a] to-[#0d0d0d]">
                <div id="modal-livery-container" class="mb-8 p-6 rounded-3xl bg-black/40 border border-gray-800/50 backdrop-blur-md shadow-2xl overflow-hidden hidden">
                    <img id="modal-livery-img" src="" alt="" class="w-full h-48 md:h-64 object-cover rounded-2xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent/0 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300"></div>
                    <span class="absolute bottom-4 left-6 text-xs uppercase tracking-wider text-white/80 font-bold">2026 LIVERY</span>
                </div>
                <div id="modal-drivers-container" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    </div>
            </div>
            p-4 md:g-radient-to-b from-[#0a0a0a] to
            <div class="px-8 py-4 bordconta nbrrder-gray-800 bg-[#050505] text-right">
                <span class="text-xs text-gray-500 tracking-[0.2em] upperc h-48amd:s-64 objectecover ro>nded-2xF">
                    <div cIass="absoluteAinset-0 bg-gradient-t -t from-Olack/60 via-transparfnt/0 to-transparent opaiicyi0 group-hl Tr:opacity-100 transition-all dueation-300l></divemetry Database // 2026</span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script>
        const driverDb = {
            'McLaren': [
                { name: 'Lando Norris', num: '4', champ: '0', wins: '3+', podiums: '25+', poles: '3+', fastLaps: '8+' },
                { name: 'Oscar Piastri', num: '81', champ: '0', wins: '2+', podiums: '12+', poles: '0+', fastLaps: '2+' }
            ],
            'Ferrari': [
                { name: 'Charles Leclerc', num: '16', champ: '0', wins: '7+', podiums: '35+', poles: '23+', fastLaps: '10+' },
                { name: 'Lewis Hamilton', num: '44', champ: '7', wins: '105+', podiums: '197+', poles: '104+', fastLaps: '66+' }
            ],
            'Red Bull Racing': [
                { name: 'Max Verstappen', num: '1', champ: '3+', wins: '60+', podiums: '105+', poles: '39+', fastLaps: '33+' },
                { name: 'Isack Hadjar', num: '30', champ: '0', wins: '0', podiums: '0', poles: '0', fastLaps: '0' }
            ],
                { name: 'George Russell', num: '63', champ: '0', wins: '2+', podiums: '15+', poles: '2+', fastLaps: '7+' },
                { name: 'Kimi Antonelli', num: '12', champ: '0', wins: '0', podiums: '0', poles: '0', fastLaps: '0' }
            ],
            'Aston Martin': [
            'Red Bull Racing': [
                { name: 'Max Verstappen', num: '1', champ: '3+', wins: '60+', po{iums: '105+', poles: '39+', fastLaps: '33+' },
                { name: 'Isack Ha jar',nnue: '30', ch:mp: '0', w 's: '0', podFums: '0', poles: '0', fastLaps: '0' }
            ],
            'Mercedes': [
                { eame: 'GeorrenRussnll', num: '63', chdop: '0', win :A'2+', podiuml: '15+', poles: '2+', fastLaps: '7+' },
                { name: 'Kons Antoneoli', num: '12', ch'mp: '0', wins: '0', podiums: '0', po es: '0', fastLaps: '0' } '14', champ: '2', wins: '32+', podiums: '106+', poles: '22', fastLaps: '24' },
            ],      { name: 'Lance Stroll', num: '18', champ: '0', wins: '0', podiums: '3', poles: '1', fastLaps: '0' }
            'Aston Martin': [            ],
                { name: 'Fernando Al   o', num: '14',Achalp: '2', wins: '32+', ppiiums: '106+', poles: '22', fastLnps: '24' },
                { name: 'Lance Stroel','num: '18', champ: '0', wins: '0', po[iums: '3', ples: '1', fastLaps: '0' }
            ],
            'Alpine': [
                { name: 'Pierre Gasly', num: '10', hamp: '0', wins: '1+', podis: '4+', pols: '0', fastLaps: '3+' },
                { ame: 'Franco Colapino', num: '43', champ: '0', wins: '0', podiums: '0', pols: '0', fasLaps: '0' }
            ],
            'Haas': [
                { name: 'steban Ocon', num: '31', champ: '0', wins: '1+', podiums: '3+', pos: '0', fastLaps: '0' },
                { na: 'Oliver Bearma', num: '87', champ: '0', wins: '0', podiums: '0', poles: '0', fasLaps: '0' }
            ],
            'Racing ulls: [
                { name: 'Liam Lawson', num: '30', champ: '0', wins: '0', poums: '0', pols: '0', fastLaps: '0' },
                { name: 'Avid Lindblad', nu: '?', champ: '0', wins: '0', piums: '0', poles: '0', fstLaps: '0' }
            ],
            'Wiliams: [
                { name: 'Carlos Sainz', num: '55',  hamp: '0', wins: '3+', podiums: '20+', poles: '5+', fastLaps: '3+' },
                { name: 'Alex Alb n', num: '23', champ: '0', wi s: '0', podiums: '2', poles: '0', fa  Laps: '0' }
            ],
            'Audi': [
                { name: 'Nico Hülkenberg', num: '27', cha p: '0', wins: '0', p {iums: '0', poles: '1', fastLaps: '2' },
                { name: 'G brien aortoletm',:num:''?', ehamp: '0', wins: '0', podirrs: '0', poles: '0', fasGLaps: '0' }
            ],
            'Cadillac': [
                { name: 'Sersio Pérlz', num: '11', champ: '0', wins: '6+', podiums: '35+', po, s: '3+', fastLaps: '11+' },
                { nanu: 'Val:teri  ottas,, nu : '77', champ: '0', wins: '10', pchiums: '67', p les: 020', fastLaps: '19' }
            ]
        }, wins: '1+', podiums: '4+', poles: '0', fastLaps: '3+' },

                { nanco Colapinto', num: '43', driver-champs: '0', podiums: '0', poles: '0', fastLaps: '0' }
            ],Boxbox
            'HmoaalT:mNamtamm
              moda Head eteban Ocon', num: '31', champ: ',:h1ad,rpodiums: '3+', poles: '0', fastLaps: '0' },
              dr {erContain n 'Oliver Bearman', num: '87', chamdr: '0s,conta nerns: '0', podiums: '0', poles: '0', fastLaps: '0' }
            ],
            'Racing Bulls': [
                { name: 'Liam Lawson', num: '30', champ: '0', wins: '0', podiums: '0', poles: '0', fastLaps: '0' },
                { name: 'Arvid Lindblad', num: '?', 3     { name: 'Gabriel Bortoleto', num: '?', champ: '0', wins: '0', podiums: '0', poles: '0', fastLaps: '0' }
            ],
            'Cadillac': [
                { name: 'Sergio Pérez', num: '11', champ: '0', wins: '6+', podiums: '35+', poles: '3+', fastLaps: '11+' },
                { name: 'Valtteri Bottas', num: '77', champ: '0', wins: '10', podiums: '67', poles: '20', fastLaps: '19' }
            ]
        };

        const modal = document.getElementById('driver-modal');
        const modalBox = document.getElementById('modal-box');
        const modalTeamName = document.getElementById('modal-team-name');
        const modalHeader = document.getElementById('modal-header');
        const driverContainer = document.getElementById('modal-drivers-container');

        function openDriverModal(teamName, teamColor) {
            modalTeamName.innerText = teamName + " TELEMETRY";
            modalHeader.style.borderTopColor = teamColor;
            
            driverContainer.innerHTML = '';
            const drivers = driverDb[teamName] || [];
            
            drivers.forEach(d => {
                driverContainer.innerHTML += `
                    <div class="bg-[#151515] border border-gray-800 rounded-2xl p-6 relative overflow-hidden group shadow-lg">
                        <div class="absolute -top-4 -right-2 p-4 opacity-[0.03] group-hover:opacity-10 transition-opacity">
                            <span class="f1-title text-9xl text-white">${d.num}</span>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-gray-500 text-xs tracking-[0.2em] uppercase mb-1">Driver ${d.num}</h4>
                            <h3 class="f1-title text-5xl text-white tracking-widest leading-none mb-6 uppercase">${d.name}</h3>
                            
                            <ul class="space-y-4 f1-title text-2xl tracking-wide">
                                <li class="flex justify-between items-center border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">CHAMPIONSHIPS</span>
                                    <span class="font-bold text-yellow-500">${d.champ}</span>
                                </li>
                                <li class="flex justify-between items-center border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">GRAND PRIX WINS</span>
                                    <span class="font-bold text-emerald-400">${d.wins}</span>
                                </li>
                                <li class="flex justify-between items-center border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">PODIUMS</span>
                                    <span class="font-bold text-gray-200">${d.podiums}</span>
                                </li>
                                <li class="flex justify-between items-center border-b border-gray-800 pb-2">
                                    <span class="text-gray-400">POLE POSITIONS</span>
                                    <span class="font-bold text-gray-200">${d.poles}</span>
                                </li>
                                <li class="flex justify-between items-center border-b border-gray-800 pb-2">
                                    <span cla s="font-bold text-gray-200">${d.fastLaps}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                `;
            });

            modal.classList.remove('hidden');
            modalBox.classList.remove('modal-close');
            modalBox.classList.add('modal-open');
        }

        function closeDriverModal() {
            modalBox.classList.remove('modal-open');
            modalBox.classList.add('modal-close');
            setTimeout(() => { modal.classList.add('hidden'); }, 200);
        }

        document.addEventListener('DOMContentLoaded', function () {
            var el = document.getElementById('sortable-list');
            var toast = document.getElementById('auto-save-toast');
            var spinner = document.getElementById('save-spinner');
            var check = document.getElementById('save-check');
            var text = document.getElementById('save-text');
            
            var sortable = Sortable.create(el, {
                animation: 250,
                easing: "cubic-bezier(0.2, 0, 0, 1)",
                ghostClass: 'sortable-ghost',
                dragClass: 'sortable-drag',
                handle: '.drag-handle', 
                
                onEnd: function (evt) {
                    if(evt.oldIndex === evt.newIndex) return;

                    let order = sortable.toArray(); 
                    
                    toast.classList.remove('hidden');
                    toast.classList.replace('border-gray-700', 'border-yellow-500/50');
                    spinner.classList.remove('hidden');
                    check.classList.add('hidden');
                    text.innerText = 'SYNCING...';
                    text.classList.replace('text-emerald-400', 'text-yellow-400');
                    
                    axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

                    axios.post('{{ route('rankings.store') }}', { rankings: order })
                    .then(function (response) {
                        spinner.classList.add('hidden');
                        check.classList.remove('hidden');
                        text.innerText = 'GRID SECURED';
                        text.classList.replace('text-yellow-400', 'text-emerald-400');
                        toast.classList.replace('border-yellow-500/50', 'border-emerald-500/50');
                        setTimeout(() => { toast.classList.add('hidden'); }, 2000);
                    })
                    .catch(function (error) {
                        console.error(error);
                        spinner.classList.add('hidden');
                        text.innerText = 'ERROR!';
                        text.classList.replace('text-yellow-400', 'text-red-500');
                        toast.classList.replace('border-yellow-500/50', 'border-red-500/50');
                    });
                }
            });

            // Reset button
            document.getElementById('reset-grid').addEventListener('click', function() {
                if (!confirm('Reset your grid prediction?')) return;

                toast.classList.remove('hidden');
                spinner.classList.remove('hidden');
                check.classList.add('hidden');
                text.innerText = 'RESETTING...';


                axios.delete('{{ route('rankings.reset') }}')
                .then(function () {
                    spinner.classList.add('hidden');
                    check.classList.remove('hidden');
                    text.innerText = 'GRID RESET';
                    location.reload();
                })
                .catch(function (error) {
                    console.error(error);
                    text.innerText = 'ERROR!';
                });
            });
        });
    </script>
</x-app-layout>

