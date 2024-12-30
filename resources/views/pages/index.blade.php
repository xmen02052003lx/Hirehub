<x-layout>
    @guest
    <h2 class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Welcome To Hirehub</h2>
        @else
    <h2 class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Welcome {{auth()->user()->name}}</h2>

    @endguest
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse ($jobs as $job)
            <x-job-card :job="$job" />
        @empty
            <li>no jobs</li>
        @endforelse
    </div>
    <a href="{{route('jobs.index')}}" class="block text-xl text-center">
        <i class="fa fa-arrow-alt-circle-right"></i> Show All Jobs
    </a>
    <x-bottom-banner />
</x-layout>