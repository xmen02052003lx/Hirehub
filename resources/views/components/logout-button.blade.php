@props(['isMobile' => false])
<form method="POST" action="{{ route('logout') }}" class="m-0">
    @csrf
    <button type="submit" class="flex items-center justify-center underline-hover-effect {{$isMobile ? 'text-white' : 'text-gray-500 font-bold'}}  ">
        <i class="fa fa-sign-out mr-1"></i>Logout
    </button>
</form>
