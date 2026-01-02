<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Kategori</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">
                    + Tambah Kategori
                </a>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
                @endif

                <table class="min-w-full border mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2 w-10">No</th>
                            <th class="border p-2">Nama Kategori</th>
                            <th class="border p-2">Deskripsi</th>
                            <th class="border p-2 w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $index => $category)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border p-2 font-bold">{{ $category->name }}</td>
                            <td class="border p-2 text-gray-600">{{ $category->description ?? '-' }}</td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                <span class="mx-2 text-gray-300">|</span>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Hati-hati! Menghapus kategori akan menghapus SEMUA BUKU dalam kategori ini. Lanjutkan?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</x-app-layout>