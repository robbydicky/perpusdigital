<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Katalog Buku') }}
            </h2>
            <a href="{{ route('my-loans') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
                Lihat Pinjaman Saya
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Gagal!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($books as $book)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col h-full">
                    <div class="h-48 bg-gray-200 w-full overflow-hidden">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-500">No Image</div>
                        @endif
                    </div>
                    
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="text-xs text-indigo-500 font-bold uppercase tracking-wide">
                            {{ $book->category->name }}
                        </div>
                        <h3 class="mt-1 text-lg font-semibold text-gray-900 leading-tight truncate">
                            {{ $book->title }}
                        </h3>
                        <p class="text-gray-600 text-sm mt-1">
                            {{ $book->author }}
                        </p>
                        
                        <div class="mt-auto pt-4 flex items-center justify-between">
                            <span class="text-sm text-gray-500">Stok: {{ $book->stock }}</span>
                            
                            <form action="{{ route('loans.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                    Pinjam
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-10 text-gray-500">
                    Belum ada buku yang tersedia saat ini.
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>