@props(['active' => false, 'url' => '/', 'icon' => false, 'mobile' => null])

@if ($mobile)
    <a href="{{ $url }}"
        class="underline-hover-effect block px-4 py-2  {{ $active ? 'font-bold' : '' }}">
        @if ($icon)
            <i class="fa fa-{{ $icon }} mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <a href="{{ $url }}"
        class="underline-hover-effect   py-2 {{ $active ? 'text-green-500 font-bold' : 'text-gray-500 font-bold' }}">
        @if ($icon)
            <i class="fa fa-{{ $icon }} mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@endif
