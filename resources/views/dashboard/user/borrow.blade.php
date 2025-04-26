@extends('layout.app')

@section('title')
    Borrow | {{ $book->title }}
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-pink-500 via-rose-600 to-red-700 py-12 flex justify-center items-center">
        <div class="container mx-auto px-6">
            <div class="bg-gray-700 text-white rounded-3xl shadow-2xl overflow-hidden p-10 transform transition hover:shadow-pink-500/50">
                
                {{-- Header --}}
                <h1 class="text-4xl font-extrabold text-pink-400 mb-10 text-center uppercase tracking-wide">Borrow Book</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    
                    {{-- Gambar Buku --}}
                    <div class="flex justify-center items-center">
                        <div class="relative group">
                            <img src="{{ asset('storage/book-images/' . $book->image) }}" alt="{{ $book->title }}"
                                class="w-full max-w-sm rounded-2xl object-cover shadow-lg transition-transform duration-300 hover:scale-110">
                            <div class="absolute inset-0 bg-black bg-opacity-20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>

                    {{-- Detail Buku --}}
                    <div class="flex flex-col justify-between space-y-6">
                        <div>
                            <h2 class="text-3xl font-bold text-pink-300 mb-4">{{ $book->title }}</h2>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-pink-200 mb-2">Description:</h3>
                                <p class="text-gray-300 leading-relaxed">{{ $book->description }}</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-pink-200">Author:</h3>
                                    <p class="text-gray-300">{{ $book->author }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-pink-200">Pages:</h3>
                                    <p class="text-gray-300">{{ $book->page_count }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-pink-200">Published:</h3>
                                    <p class="text-gray-300">{{ $book->published_year }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-pink-200">Borrow Count:</h3>
                                    <p class="text-gray-300">{{ $book->borrow_count }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-pink-200">Availability:</h3>
                                    <p class="text-gray-300">{{ $book->status }}</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-pink-200">Return Date:</h3>
                                    <p class="text-gray-300">{{ now()->addDays(7)->format('l, j F Y H:i a') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Borrow --}}
                        <div class="flex justify-end">
                            <form action="{{ route('borrow.request', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-8 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-full font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">
                                    Proceed To Borrow →
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
