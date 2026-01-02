<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Buku</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="block text-gray-700">Judul Buku</label>
                        <input type="text" name="title" value="{{ $book->title }}" class="w-full border-gray-300 rounded mt-1" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded mt-1" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Penulis</label>
                        <input type="text" name="author" value="{{ $book->author }}" class="w-full border-gray-300 rounded mt-1" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700">Penerbit</label>
                        <input type="text" name="publisher" value="{{ $book->publisher }}" class="w-full border-gray-300 rounded mt-1" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700">Tahun Terbit</label>
                        <input type="number" name="publication_year" value="{{ $book->publication_year }}" class="w-full border-gray-300 rounded mt-1" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Jumlah Stok</label>
                        <input type="number" name="stock" value="{{ $book->stock }}" class="w-full border-gray-300 rounded mt-1" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Ganti Cover (Biarkan kosong jika tidak diganti)</label>
                        <input type="file" name="cover_image" class="w-full border border-gray-300 rounded mt-1 p-2">
                        @if($book->cover_image)
                            <p class="text-sm text-gray-500 mt-2">Cover saat ini:</p>
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-20 h-auto mt-1 border">
                        @endif
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Buku</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>