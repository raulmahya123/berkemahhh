<!DOCTYPE html>
<html lang="id">
<head>
    <link href="{{ asset('css/certificate.css') }}" rel="stylesheet">
    <script src="{{ asset('js/certificate.js') }}" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sertifikat</title>
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
                            <td>{{ $certificate->user->name ?? 'Tidak ada nama pengguna' }}</td>
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
