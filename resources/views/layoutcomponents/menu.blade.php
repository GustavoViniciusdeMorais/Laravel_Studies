<nav class="flex items-center justify-between flex-wrap bg-purple-600 p-6">
    <div class="flex items-center flex-shrink-0 text white mr-6">
        <a href="/">
            <span class="font-semibold text-x1 tracking-tight">Gustavo CRUD</span>
        </a>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            <a href="/produtos" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
                Products
            </a>
            <a href="/comentarios" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
                Comentarios
            </a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-white mr-4">
                Logout
            </a>

            <form id='logout-form' action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>