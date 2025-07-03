@props(['value', 'text', 'isSelected' => false])
<option 
    value="{{ $value }}" 
    {{ $attributes->merge(['class' => 'text-gray-700 dark:bg-gray-900 dark:text-gray-400']) }}
    @if ($isSelected) selected @endif
>
    {{ $text }}
</option>