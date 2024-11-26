<x-app-layout>
    <h1>Buat Paket Baru</h1>
    <form action="{{ route('admin.paket.pakets.store') }}" method="POST">
        @csrf
        <div>
            <label>Nama Paket:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Deskripsi:</label>
            <textarea name="desc" required></textarea>
        </div>
        <div>
            <label>Slug:</label>
            <input type="text" name="slug" required>
        </div>
        <div>
            <label>Harga:</label>
            <input type="number" name="price" required>
        </div>
        <button type="submit">Simpan Paket</button>
    </form>
</x-app-layout>
