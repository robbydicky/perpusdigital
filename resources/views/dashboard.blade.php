<x-app-layout>
    {{-- Hero Section dengan Gradasi Modern --}}
    <div class="relative bg-gradient-to-r from-violet-600 to-indigo-600 text-white py-20 overflow-hidden shadow-lg mb-10 -mt-6">
        <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-400 opacity-20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 drop-shadow-md">
                Jelajahi Dunia Pengetahuan
            </h1>
            <p class="text-lg md:text-xl text-indigo-100 mb-10 max-w-2xl font-light">
                Temukan koleksi buku terbaik kami, mulai dari fiksi, teknologi, hingga sejarah. Pinjam dan baca sekarang.
            </p>
            <a href="#katalog" class="bg-white text-indigo-700 font-bold py-4 px-10 rounded-full hover:bg-indigo-50 hover:scale-105 transition-all duration-300 shadow-xl ring-4 ring-white/30">
                Lihat Katalog Sekarang
            </a>
        </div>
    </div>

    <div id="katalog" class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 px-4 sm:px-0">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                <span class="w-2 h-8 bg-indigo-600 rounded-full"></span>
                Katalog Buku Terbaru
            </h2>
            
            {{-- Flash Message --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="mt-4 md:mt-0 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 px-6 py-3 rounded-r shadow-sm flex items-center animate-pulse">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif
             @if(session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="mt-4 md:mt-0 bg-red-100 border-l-4 border-red-500 text-red-700 px-6 py-3 rounded-r shadow-sm">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4 sm:px-0">
            @forelse($books as $book)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col h-full border border-gray-100 group transform hover:-translate-y-2 overflow-hidden">
                <div class="relative h-72 w-full overflow-hidden bg-slate-100">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="flex flex-col items-center justify-center h-full text-slate-400">
                            <svg class="w-16 h-16 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 4.168 6.253v13C4.168 19.624 5.815 20 7.5 20s3.332-.477 3.332-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 3.332 1.253v13C19.832 19.624 18.185 20 16.5 20s-3.332-.477-3.332-1.253m0 0L12 14"></path></svg>
                            <span class="text-sm font-medium">No Cover</span>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-indigo-600 shadow-md border border-indigo-100">
                        {{ $book->category->name }}
                    </div>
                </div>
                
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-gray-800 leading-tight mb-2 line-clamp-2 hover:text-indigo-600 transition-colors" title="{{ $book->title }}">
                        {{ $book->title }}
                    </h3>
                    <div class="flex items-center text-gray-500 text-sm mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>{{ $book->author }}</span>
                    </div>
                    
                    <div class="mt-auto pt-5 border-t border-dashed border-gray-100 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-400 uppercase font-semibold">Stok Buku</span>
                            <span class="font-bold text-lg {{ $book->stock > 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                {{ $book->stock }} <span class="text-xs font-normal text-gray-400">eks</span>
                            </span>
                        </div>
                        
                        <form action="{{ route('loans.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" 
                                class="px-5 py-2.5 rounded-xl text-sm font-bold text-white transition-all duration-200 flex items-center gap-2
                                {{ $book->stock > 0 ? 'bg-indigo-600 hover:bg-indigo-700 hover:shadow-lg hover:-translate-y-0.5' : 'bg-gray-300 cursor-not-allowed' }}"
                                {{ $book->stock <= 0 ? 'disabled' : '' }}>
                                @if($book->stock > 0)
                                    <span>Pinjam</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                @else
                                    <span>Habis</span>
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full flex flex-col items-center justify-center py-20 bg-white/50 backdrop-blur-sm rounded-3xl border-2 border-dashed border-gray-300">
                <svg class="w-20 h-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 4.168 6.253v13C4.168 19.624 5.815 20 7.5 20s3.332-.477 3.332-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 3.332 1.253v13C19.832 19.624 18.185 20 16.5 20s-3.332-.477-3.332-1.253m0 0L12 14"></path></svg>
                <p class="text-gray-500 text-lg font-medium">Belum ada buku yang tersedia saat ini.</p>
                <p class="text-gray-400 text-sm">Silakan cek kembali nanti.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-10 px-4 sm:px-0">
             {{-- Pagination --}}
        </div>
    </div>
</x-app-layout>