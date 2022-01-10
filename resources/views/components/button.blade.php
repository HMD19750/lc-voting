@props([
    'color'=>'blue',
])

<button
    @if($color=="blue")
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center uppercase px-6 py-3 text-xs font-semibold text-white transition duration-150 ease-in border bg-blue rounded-xl border-blue hover:bg-blue-hover'])}}
    @else
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center uppercase px-6 py-3 text-xs font-semibold  transition duration-150 ease-in border bg-gray-200 rounded-xl border-gray-200 hover:border-gray-400'])}}
    @endif

>
{{ $slot }}
</button>

