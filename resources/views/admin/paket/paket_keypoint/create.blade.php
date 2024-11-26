<x-app-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Keypoint untuk Paket: {{ $paket->name }}</h1>

        <form action="{{ route('admin.paket.paket_keypoint.store', $paket) }}" method="POST" class="card p-4">
            @csrf
            <div class="form-group">
                <label for="name">Nama Keypoint:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Keypoint</button>
        </form>
    </div>
</x-app-layout>
