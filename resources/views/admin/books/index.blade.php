<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('admin.books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">
                    + Tambah Buku
                </a>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
                @endif

                <table class="min-w-full border mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Cover</th>
                            <th class="border p-2">Judul</th>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Penulis</th>
                            <th class="border p-2">Stok</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td class="border p-2 text-center">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-16 h-24 object-cover mx-auto">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="border p-2">{{ $book->title }}</td>
                            <td class="border p-2">{{ $book->category->name ?? '-' }}</td>
                            <td class="border p-2">{{ $book->author }}</td>
                            <td class="border p-2 text-center">{{ $book->stock }}</td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="text-yellow-500 hover:underline">Edit</a> |
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="mt-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>