@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<section class="p-8 bg-gradient-to-r from-pink-500 via-rose-600 to-red-700 shadow-xl text-white">
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-extrabold text-pink-400">Welcome, {{ auth()->user()->name }}</h1>
        <p class="text-lg text-gray-300 mt-2">This is your dashboard.</p>
    </div>

    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-300 border-b border-pink-500 pb-3">Book List</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @if ($books->isEmpty())
                <p class="text-center text-gray-400 col-span-full">No items found.</p>
            @endif
            @foreach ($books as $book)
                <div class="bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                    <img src="{{ asset('storage/book-images/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover rounded-md border border-pink-500 shadow-md" />
                    <h3 class="text-xl font-bold text-pink-400 mt-4">{{ $book->title }}</h3>
                    <p class="text-gray-300">by {{ $book->author }}</p>
                    <p class="text-gray-400 text-sm">Published: {{ $book->published_year }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('book.show', $book->slug) }}" class="px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-lg shadow-md transition">Detail</a>
                        @if ($book->status == 'available')
                            <a href="{{ route('dashboard.borrow', $book->slug) }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-md transition">Borrow</a>
                        @else
                            <button class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md cursor-not-allowed">Borrowed</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex flex-col items-center mt-6">
        <p class="text-gray-400 text-sm">Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} results</p>
        <div class="mt-4 flex space-x-2">
            @if ($books->onFirstPage())
                <span class="px-4 py-2 bg-gray-600 text-gray-400 rounded-lg">Prev</span>
            @else
                <a href="{{ $books->previousPageUrl() }}" class="px-4 py-2 bg-gray-700 border border-gray-500 rounded-lg hover:bg-gray-600 transition">Prev</a>
            @endif
            @for ($i = max(1, $books->currentPage() - 2); $i <= min($books->lastPage(), $books->currentPage() + 2); $i++)
                @if ($i == $books->currentPage())
                    <span class="px-4 py-2 bg-pink-500 text-white rounded-lg">{{ $i }}</span>
                @else
                    <a href="{{ $books->url($i) }}" class="px-4 py-2 bg-gray-700 border border-gray-500 rounded-lg hover:bg-gray-600 transition">{{ $i }}</a>
                @endif
            @endfor
            @if ($books->hasMorePages())
                <a href="{{ $books->nextPageUrl() }}" class="px-4 py-2 bg-gray-700 border border-gray-500 rounded-lg hover:bg-gray-600 transition">Next</a>
            @else
                <span class="px-4 py-2 bg-gray-600 text-gray-400 rounded-lg">Next</span>
            @endif
        </div>
    </div>
</section>
@endsection

@section('js')
    @if (session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                style: { background: "#F472B6" },
            }).showToast();
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Toastify({
                    text: "{{ $error }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: { background: "#EF4444" },
                }).showToast();
            </script>
        @endforeach
    @endif
@endsection
