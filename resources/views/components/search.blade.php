<form method="GET" action="{{route('jobs.search')}}" class="block mx-5 space-y-2 md:mx-auto md:space-x-2">
    <input type="text" name="keywords" placeholder="Job Title, Company, Tags"
        class="w-full md:w-72 px-4 py-3 focus:outline-none" value="{{request('keywords')}}" />

    <input type="text" name="location" placeholder="Location"
        class="w-full md:w-72 px-4 py-3 focus:outline-none" value="{{request('location')}}" />


    <button class="rounded w-full md:w-auto bg-green-700 hover:bg-green-600 text-white px-4 py-3 focus:outline-none">
        <i class="fa fa-search mr-1"></i> Search
    </button>
</form>