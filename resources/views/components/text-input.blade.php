@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-600 text-white bg-black/50 placeholder-gray-400 rounded-xl focus:ring-orange-400 focus:border-orange-400 focus:z-10 sm:text-sm shadow-sm py-3 px-4 relative block w-full hover:bg-black/60 font-medium text-base tracking-wide font-rajdhani !important']) }}>