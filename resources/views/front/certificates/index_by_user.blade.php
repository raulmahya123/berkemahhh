<!-- resources/views/certificates/index.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sertifikat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daftar Sertifikat Anda</h1>

        @if ($certificates->isEmpty())
            <p>Anda belum memiliki sertifikat.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Sertifikat</th>
                        <th>ID Kursus</th>
                        <th>ID Pengguna</th>
                        <th>Judul Sertifikat</th>
                        <th>Tanggal Diterbitkan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificates as $certificate)
                        <tr>
                            <td>{{ $certificate->id }}</td>
                            <td>{{ $certificate->certificate_code }}</td>
                            <td>{{ $certificate->course->name ?? 'Tidak ada nama kursus' }}</td>
                            <!-- Ganti course_id dengan nama kursus -->
                            <td>{{ $certificate->user->name ?? 'Tidak ada nama pengguna' }}</td>
                            <!-- Ganti user_id dengan nama pengguna -->
                            <td>{{ $certificate->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($certificate->start_date)->format('d F Y') }} -
                                {{ \Carbon\Carbon::parse($certificate->end_date)->format('d F Y') }}</td>

                            <td>
                                <a href="{{ route('front.certificates.show', $certificate->certificate_code) }}"
                                    class="btn">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        @endif

        <a href="{{ route('front.index') }}" class="btn btn-secondary">Kembali ke Beranda</a>
    </div>
</body>

</html>
