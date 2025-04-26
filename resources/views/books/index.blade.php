@extends('layout.app')

@section('title', 'Books')

@section('content')
<section class="p-16 min-h-screen bg-pink-800 text-white flex justify-center items-center">
    <div class="max-w-7xl w-full">
        
        {{-- Header & Button --}}
        <div class="flex flex-col lg:flex-row justify-between items-center mb-12 space-y-6 lg:space-y-0">
            <h1 class="text-5xl font-extrabold text-center lg:text-left text-gray-100">
                Book Collection
            </h1>
            <a href="{{ route('book.create') }}" 
                class="px-8 py-3 bg-pink-600 text-white font-semibold rounded-lg shadow-lg hover:bg-pink-500 transition-all duration-300 ease-in-out">
                Add New Book
            </a>
        </div>

        {{-- Grid Layout for Books --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @forelse ($books as $book)
                <div class="bg-gray-800 bg-opacity-80 p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105">
                    <img src="{{ asset('storage/book-images/' . $book->image) }}" 
                        alt="{{ $book->title }}" 
                        class="w-full h-64 object-cover rounded-md mb-6">
                    <h2 class="text-2xl font-semibold text-center text-white">{{ $book->title }}</h2>
                    <p class="text-md text-gray-300 text-center mb-4">{{ $book->author }} - {{ $book->published_year }}</p>

                    {{-- Actions --}}
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('book.show', $book->slug) }}" 
                            class="px-5 py-2 text-sm bg-gray-600 rounded-lg hover:bg-gray-500 transition-all duration-300">
                            View Details
                        </a>
                        <a href="{{ route('book.edit', $book->slug) }}" 
                            class="px-5 py-2 text-sm bg-pink-600 rounded-lg hover:bg-pink-500 transition-all duration-300">
                            Edit
                        </a>
                        <form action="{{ route('book.delete', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-5 py-2 text-sm bg-red-600 rounded-lg hover:bg-red-500 transition-all duration-300">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 col-span-full text-xl">No Books Available</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="flex justify-between items-center mt-12 text-gray-300">
            <p class="text-lg">Showing {{ $books->firstItem() }} - {{ $books->lastItem() }} of {{ $books->total() }} books</p>
            <div class="flex gap-4">
                @if (!$books->onFirstPage())
                    <a href="{{ $books->previousPageUrl() }}" class="px-6 py-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all duration-300">
                        Previous
                    </a>
                @endif
                @for ($i = 1; $i <= $books->lastPage(); $i++)
                    <a href="{{ $books->url($i) }}" 
                        class="px-6 py-3 {{ $books->currentPage() == $i ? 'bg-pink-600 text-white' : 'bg-gray-700 hover:bg-gray-600' }} rounded-lg transition-all duration-300">
                        {{ $i }}
                    </a>
                @endfor
                @if ($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}" class="px-6 py-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all duration-300">
                        Next
                    </a>
                @endif
            </div>
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
        stopOnFocus: true,
        style: {
            background: "linear-gradient(to right, #ec4899, #db2777)",  // Pink color gradient for success message
            borderRadius: "8px",
            padding: "12px",
            boxShadow: "0px 0px 10px rgba(236, 72, 153, 0.5)",
        },
    }).showToast();
</script>
@endif
@endsection
