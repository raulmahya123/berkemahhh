<x-app-layout>
    <!-- Tambahkan CDN Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-5">
        <h1 class="text-center mb-4">Detail Paket: {{ $paket->name }}</h1>
        
        <div class="card p-4">
            <p><strong>Deskripsi:</strong> {{ $paket->desc }}</p>
            <p><strong>Slug:</strong> {{ $paket->slug }}</p>
            <p><strong>Harga:</strong> {{ $paket->getFormattedPrice() }}</p>

            <div class="mt-3">
                <a href="{{ route('admin.paket.pakets.edit', $paket) }}" class="btn btn-primary">Edit Paket</a>
                
                <form action="{{ route('admin.paket.pakets.destroy', $paket) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Paket</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
