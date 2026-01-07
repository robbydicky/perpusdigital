<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-blue-100 text-sm font-medium mb-1">Sedang Dipinjam</p>
                            <h3 class="text-3xl font-bold">{{ $activeLoans }}</h3>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 4.168 6.253v13C4.168 19.624 5.815 20 7.5 20s3.332-.477 3.332-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 3.332 1.253v13C19.832 19.624 18.185 20 16.5 20s-3.332-.477-3.332-1.253m0 0L12 14" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white transform hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-emerald-100 text-sm font-medium mb-1">Total Judul Buku</p>
                            <h3 class="text-3xl font-bold">{{ $totalTitles }}</h3>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg p-6 text-white transform hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-indigo-100 text-sm font-medium mb-1">Total Eksemplar</p>
                            <h3 class="text-3xl font-bold">{{ $totalBooks }}</h3>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-xl shadow-lg p-6 text-white transform hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-orange-100 text-sm font-medium mb-1">Total Anggota</p>
                            <h3 class="text-3xl font-bold">{{ $totalUsers }}</h3>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Akses Cepat Section --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Akses Cepat
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ route('admin.loans.index') }}" class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg hover:bg-indigo-50 hover:border-indigo-200 transition group">
                        <div class="p-3 bg-white rounded-full text-indigo-600 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-gray-800 group-hover:text-indigo-700">Kelola Peminjaman</p>
                            <p class="text-sm text-gray-500">Lihat dan proses transaksi</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.books.create') }}" class="flex items-center p-4 bg-gray-50 border border-gray-200 rounded-lg hover:bg-emerald-50 hover:border-emerald-200 transition group">
                        <div class="p-3 bg-white rounded-full text-emerald-600 shadow-sm group-hover:bg-emerald-600 group-hover:text-white transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-gray-800 group-hover:text-emerald-700">Tambah Buku Baru</p>
                            <p class="text-sm text-gray-500">Input data buku ke sistem</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>