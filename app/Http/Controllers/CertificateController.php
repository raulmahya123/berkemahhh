<?php
namespace App\Http\Controllers;

use PDF;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Import Rule class

class CertificateController extends Controller
{
    // Display a listing of the certificates
    public function index()
    {
        $certificates = Certificate::all();
        return view('front.certificate.index', compact('certificates'));
    }

    // Show the form to create a new certificate
    public function create()
    {
        $courses = Course::all();
        $users = User::all();
        return view('front.certificate.create', compact('courses', 'users'));
    }

    // Store a newly created certificate in storage
    public function store(Request $request)
    {
        $request->validate([
            'certificate_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('certificates'), // Ensure the certificate code is unique
            ],
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
            'issued_date' => 'required|date',
        ]);

        Certificate::create([
            'certificate_code' => $request->certificate_code,
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'issued_date' => $request->issued_date,
        ]);

        return redirect()->route('front.certificate.index')->with('success', 'Certificate created successfully.');
    }

    // Display the specified certificate
    public function show(Certificate $certificate)
    {
        return view('front.certificate.show', compact('certificate'));
    }

    public function showCertificateUser($id)
{
    $certificate = Certificate::with(['course', 'user'])->findOrFail($id);
    dd($certificate); // Ini untuk debugging
    return view('front.certificates.show', compact('certificate'));
}




    public function indexCertificateUser(Request $request)
    {
        $userId = $request->user()->id; // Ambil ID pengguna yang sedang login
        $certificates = Certificate::where('user_id', $userId)->get(); // Ambil sertifikat berdasarkan user_id

        return view('front.certificates.index_by_user', compact('certificates')); // Ganti dengan view yang sesuai
    }
    // Show the form to edit the specified certificate
    public function edit(Certificate $certificate)
    {
        $courses = Course::all();
        $users = User::all();
        return view('front.certificate.edit', compact('certificate', 'courses', 'users'));
    }

    // Update the specified certificate in storage
    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'certificate_code' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
            'issued_date' => 'required|date',
        ]);

        $certificate->update([
            'certificate_code' => $request->certificate_code,
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'issued_date' => $request->issued_date,
        ]);

        return redirect()->route('front.certificate.index')->with('success', 'Certificate updated successfully.');
    }

    // Delete the specified certificate
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('front.certificate.index')->with('success', 'Certificate deleted successfully.');
    }

    public function generateCertificate(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_name' => 'required|string|max:255', // Hanya nama pengguna yang diinput
            'course_slug' => 'required|string',
        ]);

        // Ambil kursus berdasarkan slug
        $course = Course::where('slug', $request->course_slug)->firstOrFail();

        // Cek apakah pengguna terautentikasi
        if (auth()->check()) {
            // Jika ya, gunakan pengguna terautentikasi
            $user = auth()->user();
        } else {
            // Jika tidak, temukan atau buat pengguna berdasarkan nama
            $user = User::firstOrCreate(['name' => $request->user_name]);
        }

        // Cek apakah sertifikat sudah pernah dibuat untuk pengguna dan kursus ini
        $existingCertificate = Certificate::where('user_id', $user->id)->where('course_id', $course->id)->first();
        if ($existingCertificate) {
            // Redirect ke halaman tampilan sertifikat dengan pesan bahwa sertifikat sudah ada
            return redirect()->route('front.certificates.show', ['certificate_code' => $existingCertificate->certificate_code])
                ->with('warning', 'Certificate has already been generated for this course.');
        }

        // Generate kode sertifikat yang unik
        $certificateCode = strtoupper(uniqid('CERT-'));

        // Buat sertifikat
        $certificate = Certificate::create([
            'certificate_code' => $certificateCode,
            'course_id' => $course->id,
            'user_id' => $user->id,
            'issued_date' => now(), // Tanggal penerbitan diatur otomatis ke waktu saat ini
        ]);

        // Redirect ke halaman tampilan sertifikat
        return redirect()->route('front.certificates.show', ['certificate_code' => $certificateCode])
            ->with('success', 'Certificate generated successfully!');
    }
    public function downloadCertificate($id)
    {
        // Temukan data sertifikat berdasarkan ID
        $certificate = Certificate::findOrFail($id);
        $user = User::findOrFail($certificate->user_id);

        // Buat PDF dari view 'front.generate_certificate' dengan data pengguna dan sertifikat
        $pdf = PDF::loadView('front.generate_certificate', compact('user', 'certificate'));

        // Langsung mendownload PDF tanpa menampilkan view
        return $pdf->download('certificate_'.$certificate->certificate_code.'.pdf');
    }
    public function showCertificate($certificate_code)
{
    $certificate = Certificate::where('certificate_code', $certificate_code)->firstOrFail();
    $course = $certificate->course;
    $user = $certificate->user;

    // Convert issued_date to Carbon instance
    $issuedDate = \Carbon\Carbon::parse($certificate->issued_date);

    return view('front.certificates.show', [
        'certificate' => $certificate,
        'course' => $course,
        'user' => $user,
        'issuedDate' => $issuedDate,
    ]);
}



}
