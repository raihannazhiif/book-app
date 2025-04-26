<div class="flex justify-between items-center px-6 py-4 bg-gray-800 text-white shadow-md">
    <!-- Logo -->
    <a href="/" class="text-3xl font-bold text-rose-400 hover:text-rose-300 transition-all">
        Perpus<span class="text-white">Kita</span>
    </a>

    <!-- Navigation -->
    <nav class="flex items-center gap-4">
        @auth
            <span class="text-sm text-gray-300 hidden sm:inline">Hello, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-md shadow transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('sign-in-form') }}"
               class="px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-md shadow transition text-sm">
                Sign In
            </a>
            <a href="{{ route('sign-up-form') }}"
   class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-md shadow transition text-sm">
    Sign Up
</a>

        @endauth
    </nav>
</div>
