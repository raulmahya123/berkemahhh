<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            text-align: center;
        }
        .certificate {
            border: 10px solid gold;
            padding: 20px;
        }
        h1 {
            font-size: 50px;
        }
        p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Certificate of Completion</h1>
        <p>This certifies that</p>
        <h2>{{ $user->name }}</h2>
        <p>has successfully completed the course</p>
        <h2>{{ $course->title }}</h2>
        <p>Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
    </div>
</body>
</html>
