<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Buku Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700">Judul Buku</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded mt-1" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded mt-1" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">Penulis</label>
                            <input type="text" name="author" class="w-full border-gray-300 rounded mt-1" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Penerbit</label>
                            <input type="text" name="publisher" class="w-full border-gray-300 rounded mt-1" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700">Tahun Terbit</label>
                            <input type="number" name="publication_year" class="w-full border-gray-300 rounded mt-1" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Jumlah Stok</label>
                            <input type="number" name="stock" class="w-full border-gray-300 rounded mt-1" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Cover Buku (Opsional)</label>
                        <input type="file" name="cover_image" class="w-full border border-gray-300 rounded mt-1 p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Sinopsis</label>
                        <textarea name="synopsis" rows="3" class="w-full border-gray-300 rounded mt-1"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan Buku</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>