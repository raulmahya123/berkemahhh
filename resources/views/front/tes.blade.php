<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tes</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Daftar Kursus</h1>

        @if($courses->isEmpty())
            <p>Tidak ada kursus yang tersedia.</p>
        @else
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset($course->thumbnail) }}" class="card-img-top" alt="{{ $course->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->name }}</h5>
                                <p class="card-text">{{ Str::limit($course->about, 100) }}</p>
                                <p class="card-text">
                                    <strong>Kategori:</strong> {{ $course->category->name }}
                                </p>
                                <p class="card-text">
                                    <strong>Pengajar:</strong> {{ $course->teacher->user->name }}
                                </p>
                                <a href="{{ route('courses.getall', $course->id) }}" class="btn btn-primary">Lihat Kursus</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
