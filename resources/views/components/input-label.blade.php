@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm mb-1.5 text-gray-700 dark:text-gray-400']) }}>
    {{ $value ?? $slot }}
</label>
