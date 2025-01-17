<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\JenisKegiatan;
use App\Models\kegiatan;
use App\Models\TingkatKegiatan;
use App\Models\Posisi;
use App\Models\Poin;

class formControl extends Controller
{

    protected $processController;

    // Inject ProcessController
    public function __construct(ProcessController $processController)
    {
        $this->processController = $processController;
    }
    /**
     * Display a listing of the resource.
     */
    public function indexMahasiswa()
    {
        // $mahasiswa = session()->has('nim');
        $data = Poin::with(['posisi', 'tingkatKegiatan', 'jenisKegiatan'])->get();
        $posisi = Posisi::all(); // Data untuk dropdown posisi
        $tingkatKegiatan = TingkatKegiatan::all();
        $jenisKegiatan = JenisKegiatan::all();
        // $kegiatan = Kegiatan::where('nim',$mahasiswa)->get();

        // dd($posisi);
        // dd($mahasiswa);

        return view('mhs.dashboardMhs', compact('data', 'posisi', 'tingkatKegiatan', 'jenisKegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $nim = session('nim');
        // Validasi data
        $request->validate([
            'Nim' => 'required|string|max:255',
            'Nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'id_posisi' => 'required|exists:posisi,id_posisi',
            'idtingkat_kegiatan' => 'required|exists:tingkat_kegiatan,idtingkat_kegiatan',
            'idjenis_kegiatan' => 'required|exists:jenis_kegiatan,idjenis_kegiatan',
            'sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Direktori tujuan
        $destinationPath = public_path('image/sertifikat');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // File sertifikat
        $file = $request->file('sertifikat');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $originalName . '.' . $extension;

        // Pastikan nama file unik
        $counter = 1;
        while (file_exists($destinationPath . '/' . $fileName)) {
            $fileName = $originalName . '_' . $counter++ . '.' . $extension;
        }

        // Pindahkan file ke folder tujuan
        $file->move($destinationPath, $fileName);

        // Path lengkap sertifikat
        $filePath = 'image/sertifikat/' . $fileName;

        // Path ke logo
        $logoPath = public_path('image/logo_pnb.jpg');
        $certificatePath = public_path($filePath);

        // Jalankan skrip Python untuk verifikasi sertifikat
        $output = shell_exec("python3 /path/to/your/detect_logo.py " . escapeshellarg($logoPath) . " " . escapeshellarg($certificatePath));

        // Cek hasil dari skrip Python
        $isVerified = trim($output) === "True";

        // Log hasil verifikasi
        if ($isVerified) {
            Log::info("Certificate verified successfully for Nim: {$request->Nim}");
        } else {
            Log::warning("Certificate verification failed for Nim: {$request->Nim}");
        }

        // Mencari id_poin berdasarkan kombinasi
        $poin = Poin::where('id_posisi', $request->id_posisi)
            ->where('idtingkat_kegiatan', $request->idtingkat_kegiatan)
            ->where('idjenis_kegiatan', $request->idjenis_kegiatan)
            ->first();

        // Cek apakah id_poin ditemukan
        if (!$poin) {
            return redirect()->back()->withErrors(['msg' => 'Poin tidak ditemukan untuk kombinasi yang diberikan.']);
        }
        // dd($request->Nim);

        // Simpan data ke database
        Kegiatan::create([
            'Nim' => $request->Nim,
            'Nama_kegiatan' => $request->Nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'id_posisi' => $request->id_posisi,
            'idtingkat_kegiatan' => $request->idtingkat_kegiatan,
            'idjenis_kegiatan' => $request->idjenis_kegiatan,
            'sertifikat' => $filePath,
            'verifsertif' => $isVerified,
            'verif' => false,
            'id_poin' => $poin->id_poin,
        ]);
        

        return redirect()->route('indexMhs')->with('success', 'Kegiatan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
