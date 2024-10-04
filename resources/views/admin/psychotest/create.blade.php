{{-- resources/views/admin/psychotest/create.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pertanyaan Psikotes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Link to your CSS file --}}
</head>
<body>
    <div class="container">
        <h1>Tambah Pertanyaan Psikotes</h1>

        {{-- Display success message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form to create a new psychotest question --}}
        <form action="{{ route('psychotest.question.store', $psychotestId) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="question">Pertanyaan:</label>
                <input type="text" class="form-control" name="question" required>
            </div>
            <div class="form-group">
                <label for="type">Tipe:</label>
                <select class="form-control" name="type" required>
                    <option value="frontend">Frontend</option>
                    <option value="backend">Backend</option>
                    <option value="devops">DevOps</option>
                </select>
            </div>
            <input type="hidden" name="psychotest_id" value="{{ $psychotestId }}"> {{-- Include psychotest_id in a hidden input --}}
            <button type="submit" class="btn btn-primary">Tambah Pertanyaan</button>
            <a href="{{ route('admin.psychotest.index') }}" class="btn btn-secondary">Kembali</a> {{-- Back button --}}
        </form>
    </div>
</body>
</html>
