<x-app-layout>
    <!-- Tambahkan CDN Bootstrap jika belum ada di layout utama -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Paket: {{ $paket->name }}</h1>

        <form action="{{ route('admin.paket.pakets.update', $paket) }}" method="POST" class="card p-4">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Nama Paket:</label>
                <input type="text" id="name" name="name" value="{{ $paket->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="desc">Deskripsi:</label>
                <textarea id="desc" name="desc" class="form-control" required>{{ $paket->desc }}</textarea>
            </div>

            <div class="form-group">
                <label for="slug">Slug:</label>
                <input type="text" id="slug" name="slug" value="{{ $paket->slug }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" value="{{ $paket->price }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
        </form>
    </div>
</x-app-layout>
