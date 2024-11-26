<x-app-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Keypoint untuk Paket: {{ $paket->name }}</h1>

        <form action="{{ route('admin.paket.keypoints.update', [$paket, $keypoint]) }}" method="POST" class="card p-4">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Keypoint:</label>
                <input type="text" id="name" name="name" value="{{ $keypoint->name }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
        </form>
    </div>
</x-app-layout>
