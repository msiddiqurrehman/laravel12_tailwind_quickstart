@props([
    'name',      // The name for the hidden input (e.g., 'status', 'is_active')
    'id' => null, // Unique ID for the checkbox and label (will be auto-generated if null)
    'label',     // The text label to display next to the toggle
    'checked' => false, // Initial state of the toggle (true for 'on', false for 'off')
    'value' => 1, // Value to submit when checked (defaults to 1)
    'uncheckedValue' => 0, // Value to submit when unchecked (defaults to 0)
])

@php
    // Generate a unique ID if not provided
    $componentId = $id ?? 'toggle-' . \Illuminate\Support\Str::random(8);
@endphp

<div x-data="{ switcherToggle: {{ json_encode((bool)$checked) }} }">
    <label
      for="{{ $componentId }}"
      class="flex w-25 cursor-pointer items-center gap-3 text-sm font-medium text-gray-700 select-none dark:text-gray-400"
    >
    {{ $label }}
        <div class="relative">
            <input
                type="hidden"
                name="{{ $name }}" {{-- This is the crucial 'name' for form submission --}}
                :value="switcherToggle ? {{ $value }} : {{ $uncheckedValue }}" {{-- Binds to 1 when on, 0 when off --}}
            />
            <input
                type="checkbox"
                id="{{ $componentId }}"
                class="sr-only"
                x-model="switcherToggle"
                {{-- @change="switcherToggle = !switcherToggle" --}}
            />
            <div
                class="block h-6 w-11 rounded-full"
                :class="switcherToggle ? 'bg-brand-500 dark:bg-brand-500' : 'bg-gray-200 dark:bg-white/10'"
            ></div>
            <div
                :class="switcherToggle ? 'translate-x-full': 'translate-x-0'"
                class="shadow-theme-sm absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white duration-300 ease-linear"
            ></div>
        </div>
    </label>
</div>