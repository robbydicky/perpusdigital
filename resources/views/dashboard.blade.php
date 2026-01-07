<x-app-layout>
    {{-- Hero Section --}}
    <div class="bg-indigo-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
                Jelajahi Dunia Pengetahuan
            </h1>
            <p class="text-lg md:text-xl text-indigo-100 mb-8 max-w-2xl">
                Temukan koleksi buku terbaik kami, mulai dari fiksi, teknologi, hingga sejarah. Pinjam dan baca sekarang.
            </p>
            <a href="#katalog" class="bg-white text-indigo-700 font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition duration-300 shadow-lg">
                Lihat Katalog
            </a>
        </div>
    </div>

    <div id="katalog" class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8 px-4 sm:px-0">
                <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-indigo-600 pl-4">
                    Katalog Buku Terbaru
                </h2>
                {{-- Flash Message --}}
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded shadow-sm text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded shadow-sm text-sm">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4 sm:px-0">
                @forelse($books as $book)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full border border-gray-100 group">
                    <div class="relative h-64 w-full overflow-hidden bg-gray-200">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex flex-col items-center justify-center h-full text-gray-400">
                                <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 4.168 6.253v13C4.168 19.624 5.815 20 7.5 20s3.332-.477 3.332-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 3.332 1.253v13C19.832 19.624 18.185 20 16.5 20s-3.332-.477-3.332-1.253m0 0L12 14"></path></svg>
                                <span>No Cover</span>
                            </div>
                        @endif
                        <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded text-xs font-bold text-indigo-600 uppercase tracking-wide shadow-sm">
                            {{ $book->category->name }}
                        </div>
                    </div>
                    
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1 line-clamp-2" title="{{ $book->title }}">
                            {{ $book->title }}
                        </h3>
                        <p class="text-gray-500 text-sm mb-4">
                            Oleh: <span class="font-medium text-gray-700">{{ $book->author }}</span>
                        </p>
                        
                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div class="text-sm">
                                <span class="text-gray-500">Stok:</span>
                                <span class="font-bold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $book->stock }}
                                </span>
                            </div>
                            
                            <form action="{{ route('loans.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" 
                                    class="px-4 py-2 rounded-lg text-sm font-semibold text-white transition duration-200 
                                    {{ $book->stock > 0 ? 'bg-indigo-600 hover:bg-indigo-700 shadow-md hover:shadow-lg' : 'bg-gray-400 cursor-not-allowed' }}"
                                    {{ $book->stock <= 0 ? 'disabled' : '' }}>
                                    {{ $book->stock > 0 ? 'Pinjam Buku' : 'Habis' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 bg-white rounded-lg shadow-sm border border-dashed border-gray-300">
                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 4.168 6.253v13C4.168 19.624 5.815 20 7.5 20s3.332-.477 3.332-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 3.332 1.253v13C19.832 19.624 18.185 20 16.5 20s-3.332-.477-3.332-1.253m0 0L12 14"></path></svg>
                    <p class="text-gray-500 text-lg">Belum ada buku yang tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
            
            <div class="mt-8 px-4 sm:px-0">
                {{-- Pagination Styling (jika ada) --}}
                {{-- {{ $books->links() }} --}}
            </div>

        </div>
    </div>
</x-app-layout>