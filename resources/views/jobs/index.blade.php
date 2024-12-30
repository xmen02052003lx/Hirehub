<x-layout>
    <div class=" h-24 px-4 mt-4 mb-8 flex justify-center items-center rounded">
        <x-search />
    </div>
    {{-- Back button --}}
    @if (request()->has('keywords') || request()->has('location'))
        <a href="{{ route('jobs.index') }}"
            class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded mb-4 inline-block">
            <i class="fa fa-arrow-left mr-1"></i> Back
        </a>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse ($jobs as $job)
            <x-job-card :job="$job" />
        @empty
            <li>no jobs</li>
        @endforelse
    </div>
    {{ $jobs->links() }}
</x-layout>
