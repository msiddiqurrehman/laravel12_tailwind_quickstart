<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-1 text-lg font-semibold text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600']) }}>
    {{ $slot }}
</button>
