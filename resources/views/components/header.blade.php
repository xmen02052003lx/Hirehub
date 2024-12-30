<header class="header bg-white text-white p-4" x-data="{ open: false }">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-green-500">
            <a url={{ url('/') }}>Hirehub</a>
        </h1>
        <nav class="navbar hidden md:flex items-center space-x-4">
            <x-nav-link url="{{ url('/') }}" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link url="{{ url('/jobs') }}" :active="request()->is('jobs')">All Jobs</x-nav-link>
            @auth
                <x-nav-link url="{{ url('/bookmarks') }}" :active="request()->is('bookmarks')">Bookmarks</x-nav-link>

                <x-logout-button />
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                class="w-10 h-10 rounded-full">
                        @else
                            <img src="{{ asset('storage/avatars/default-avatar.png') }}" alt="{{ Auth::user()->name }}"
                                class="w-10 h-10 rounded-full">
                        @endif
                    </a>
                </div>
                <x-button-link url="{{ url('jobs/create') }}" icon='edit'>Create Jobs</x-button-link>
            @else
                <x-nav-link url="{{ url('/login') }}" :active="request()->is('login')">Login</x-nav-link>
                <x-nav-link url="{{ url('/register') }}" :active="request()->is('register')">Register</x-nav-link>
            @endauth

        </nav>
        <button @click="open = !open" id="hamburger" class="text-gray-500 md:hidden flex items-center">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav x-show="open" @click.away="open = false" id="mobile-menu" x-transition
        class="md:hidden bg-green-900 text-white mt-5 pb-4 space-y-2">
        <x-nav-link url="{{ url('/jobs') }}" :active="request()->is('jobs')" :mobile="true">All Jobs</x-nav-link>
        @auth

            <x-nav-link url="{{ url('/bookmarks') }}" :active="request()->is('bookmarks')" :mobile="true">Bookmarks</x-nav-link>
            <x-nav-link url="{{ url('/dashboard') }}" :active="request()->is('dashboard')" :mobile="true">Dashboard</x-nav-link>
            <x-logout-button :isMobile="true" />
            <x-button-link url="{{ url('jobs/create') }}" icon='edit' :block="true">Create Jobs</x-button-link>
        @else
            <x-nav-link url="{{ url('/login') }}" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
            <x-nav-link url="{{ url('/register') }}" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
        @endauth

    </nav>
</header>
