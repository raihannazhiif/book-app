@extends('layout.app')

@section('title')
    Sign Up
@endsection

@section('content')
<main class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-500 via-fuchsia-800 to-black p-6">
    <div class="w-full max-w-md bg-gray-700 text-white rounded-3xl shadow-2xl p-8 transition-transform transform hover:shadow-pink-500/50">
        
        {{-- Header --}}
        <h1 class="text-center text-4xl font-extrabold text-pink-400 tracking-wide">Create Account</h1>
        <p class="text-center text-gray-300 mt-2">Join us and explore unlimited books</p>

        {{-- Form --}}
        <form action="{{ route('register') }}" method="POST" class="mt-6 space-y-4">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-pink-300">Name</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-pink-300">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-pink-300">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-pink-300">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-3 border border-gray-600 rounded-lg shadow-sm bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 transition">
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-center">
                <button type="submit"
                    class="w-full py-3 px-6 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-full shadow-md transition-transform transform hover:scale-105">
                    Sign Up
                </button>
            </div>
        </form>

        {{-- Sign-In Redirect --}}
        <p class="text-center text-gray-300 mt-6">
            Already have an account? 
            <a href="{{ route('sign-in-form') }}" class="text-pink-400 hover:underline">Sign In</a>
        </p>
    </div>
</main>
@endsection

@section('js')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Toastify({
                text: "{{ $error }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "red",
                    border: "1px solid red",
                    borderRadius: "8px",
                    padding: "10px"
                },
            }).showToast();
        </script>
    @endforeach
@endif
@endsection
