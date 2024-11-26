<x-app-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Detail Keypoint: {{ $keypoint->name }}</h1>
        
        <div class="card p-4">
            <p><strong>Paket:</strong> {{ $paket->name }}</p>
            <p><strong>Nama Keypoint:</strong> {{ $keypoint->name }}</p>

            <a href="{{ route('admin.paket.keypoints.edit', [$paket, $keypoint]) }}" class="btn btn-primary mt-3">Edit Keypoint</a>
            <form action="{{ route('admin.paket.keypoints.destroy', [$paket, $keypoint]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-3">Hapus Keypoint</button>
            </form>
        </div>
    </div>
</x-app-layout>
