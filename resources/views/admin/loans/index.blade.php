<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Peminjaman</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold">Daftar Transaksi</h3>
        <a href="{{ route('admin.loans.print') }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Cetak Laporan PDF
        </a>
    </div>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border mt-4">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-2">Peminjam</th>
                                <th class="border p-2">Buku</th>
                                <th class="border p-2">Tgl Pinjam</th>
                                <th class="border p-2">Wajib Kembali</th>
                                <th class="border p-2">Status</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2">{{ $loan->user->name }}</td>
                                <td class="border p-2">{{ $loan->book->title }}</td>
                                <td class="border p-2">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</td>
                                <td class="border p-2 text-red-600">
                                    {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                                </td>
                                <td class="border p-2 text-center">
                                    @if($loan->status == 'borrowed')
                                        <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">Sedang Dipinjam</span>
                                    @elseif($loan->status == 'returned')
                                        <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="border p-2 text-center">
                                    @if($loan->status == 'borrowed')
                                        <form action="{{ route('admin.loans.return', $loan->id) }}" method="POST" onsubmit="return confirm('Proses pengembalian buku ini?')">
                                            @csrf
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                Proses Kembali
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $loans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>