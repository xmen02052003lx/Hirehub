<x-layout>
    <div class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12">
        <h2 class="text-4xl text-center font-bold mb-4">Register</h2>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <x-inputs.text id="name" name="name" placeholder="Full name" />
            <x-inputs.text id="email" name="email" placeholder="Email address" type="email" />

            <x-inputs.text id="password" name="password" placeholder="Password" type="password" />
            {{-- The "name" prop has to be "password_confirmation" for laravel to work  --}}
            <x-inputs.text id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"
                type="password" />
            <button type="submit"
                class="bg-green-500 block text-white w-full rounded hover:bg-green-600 py-2 px-4">Register</button>
        </form>
        <p class="mt-4 text-gray-500">
            Already have an account?
            <a href="{{route('login')}}" class="text-blue-500">Login</a>
        </p>
    </div>
</x-layout>
