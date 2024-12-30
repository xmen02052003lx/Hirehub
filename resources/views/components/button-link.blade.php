@props([
    'url' => '/',
    'icon' => null,
    'bgClass' => 'bg-green-500',
    'hoverClass' => 'hover:bg-green-600',
    'textClass' => 'text-white',
    'block' => false
])

<a href={{ $url }}
    class="{{ $bgClass }} {{ $hoverClass }} {{ $textClass }} px-4 py-2 rounded hover:shadow-md transition duration-300 {{$block ? 'block' : ''}}">
    @if ($icon)
        <i class="fa fa-{{ $icon }} mr-1"></i>
    @endif
    {{ $slot }}
</a>
