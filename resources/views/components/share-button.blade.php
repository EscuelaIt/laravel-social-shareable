@props([
    'model',
    'type',
])

@php
    /** @var \Illuminate\Database\Eloquent\Model $model */
    $url = $model->getShareUrl($type);

    $label = \Illuminate\Support\Str::of($type)->replace('-', ' ')->title();

    // Clases base del botón
    $baseClasses = 'inline-flex items-center gap-2 rounded-md px-3 py-2 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2';

    // Estilos rápidos por red (puedes afinar más adelante)
    $colorClasses = match ($type) {
        'facebook' => 'bg-blue-600 text-white hover:bg-blue-700 focus-visible:outline-blue-600',
        'x', 'twitter' => 'bg-slate-900 text-white hover:bg-black focus-visible:outline-slate-900',
        default => 'bg-gray-100 text-gray-900 hover:bg-gray-200 focus-visible:outline-gray-300',
    };

    $classes = $baseClasses.' '.$colorClasses;
@endphp

<a href="{{ $url }}"
   target="_blank"
   rel="noopener noreferrer"
   class="{{ $classes }}"
>
    {{-- Aquí podrías añadir un icono SVG específico según $type más adelante --}}
    <span>Compartir en {{ $label }}</span>
</a>
