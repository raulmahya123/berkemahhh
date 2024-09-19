{{-- resources/views/certificates/show.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Certificate</title>
</head>
<body>
    <h1>Certificate of Completion</h1>
    <p><strong>Certificate Code:</strong> {{ $certificate->certificate_code }}</p>
    <p><strong>Course:</strong> {{ $course->name }}</p>
    <p><strong>User:</strong> {{ $user->name }}</p>
    <p><strong>Date Issued:</strong> {{ \Carbon\Carbon::parse($certificate->issued_date)->format('d-m-Y') }}</p>
</body>
</html>
