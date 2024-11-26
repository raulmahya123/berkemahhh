<x-app-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Keypoints untuk Paket: {{ $paket->name }}</h1>
        <a href="{{ route('admin.paket.paket_keypoint.create', $paket) }}" class="btn btn-success mb-3">Tambah Keypoint</a>

        <ul class="list-group">
            @foreach($keypoints as $keypoint)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $keypoint->name }}
                    <div>
                        <a href="{{ route('admin.paket.paket_keypoint.edit', [$paket, $keypoint]) }}" class="btn btn-sm btn-primary">Edit</a>
                        {{-- <form action="{{ route('admin.paket.paket_keypoint.destroy', [$paket, $keypoint]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form> --}}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
