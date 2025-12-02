<?php

namespace App\Http\Controllers;
use App\Models\Jbi;
use App\Models\Pemesanan;
use Carbon\Carbon;

use Illuminate\Http\Request;

class JbiController extends Controller
{
    public function index(Request $request)
    {
            // Kalau admin atau ketua ULD, tampilkan semua tanpa filter
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'ketua_uld') {
            $jbis = Jbi::all();
            return view('admin.jbi.index', compact('jbis'));
        }

        // Kalau bukan admin (user biasa), tampilkan semua JBI
        $query = Jbi::query();

        // Filter pencarian nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori (misalnya JBI tuli/dengar/mentor)
        if ($request->filled('kategori')) {
            $query->where('keahlian', $request->kategori); // Pastikan nama kolomnya benar
        }

        $jbis = $query->paginate(12); // 12 JBI per page
        return view('user.jbi.index', compact('jbis'));
    }

    public function create()
    {
        return view('admin.jbi.create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'keahlian' => 'required|string|max:255',
        'jk' => 'required|in:Laki-laki,Perempuan',
        'no_hp' => 'required|string|max:20',
        'ketersediaan' => 'required|in:Tersedia,Tidak Tersedia',
        'jadwal' => 'required|string|max:255',
         'jam' => 'nullable|string|max:50',
         'jam_selesai' => 'required|string|max:255',
        'alamat' => 'required|string',
        'layanan' => 'required|in:Gratis,Berbayar',
        'status' => 'required|in:aktif,tidak aktif',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // Maksimal 5MB
    ]);

    $fotoName = null;
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $fotoName = time().'_'.$foto->getClientOriginalName();
        $foto->move(public_path('uploads/foto_jbi'), $fotoName);
    }

    Jbi::create([
        'nama' => $validated['nama'],
        'keahlian' => $validated['keahlian'],
        'jk' => $validated['jk'],
        'no_hp' => $validated['no_hp'],
        'ketersediaan' => $validated['ketersediaan'],
        'jadwal' => $validated['jadwal'],
        'jam' => $validated['jam'] ?? null,
         'jam_selesai' => $validated['jam_selesai'],
        'alamat' => $validated['alamat'],
        'layanan' => $validated['layanan'],
        'status' => $validated['status'],
        'foto' => $fotoName,
    ]);

    return redirect()->back()->with('success', 'JBI berhasil ditambahkan');
}


    public function show(Jbi $jbi)
    {
         $jbi = Jbi::findOrFail($id);

    if (auth()->user()->role === 'admin' || auth()->user()->role === 'ketua_uld') {
        return view('admin.jbi.show', compact('jbi'));
    } else {
        return view('user.jbi.show', compact('jbi'));
    }
    }

    public function edit(Jbi $jbi)
    {
        return view('admin.jbi.edit', compact('jbi'));
    }

public function update(Request $request, Jbi $jbi)
{
    $request->validate([
        'nama' => 'required',
        'keahlian' => 'required',
        'jk' => 'required',
        'no_hp' => 'required',
        'ketersediaan' => 'required',
        'jadwal' => 'required',
        'status' => 'required|in:aktif,tidak aktif',
    ]);

    $jbi->update([
        'nama' => $request->nama,
        'keahlian' => $request->keahlian,
        'jk' => $request->jk,
        'no_hp' => $request->no_hp,
        'ketersediaan' => $request->ketersediaan,
        'jadwal' => $request->jadwal,
        'status' => $request->status, 
        'layanan' => $request->layanan ?? $jbi->layanan,
        'alamat' => $request->alamat ?? $jbi->alamat,
    ]);

    return redirect()->route('admin.jbi.index')->with('success', 'JBI berhasil diperbarui');
}

    public function destroy(Jbi $jbi)
    {
        $jbi->delete();
        return redirect()->route('admin.jbi.index')->with('success', 'JBI berhasil dihapus');
    }
    

    // ini untuk order
    public function order($id)
        {
            $jbi = Jbi::findOrFail($id); // Ambil data JBI berdasarkan id
            
            // Cek apakah JBI aktif
            if ($jbi->status !== 'aktif') {
                return redirect()->route('user.jbi.index')
                    ->with('error', 'JBI yang Anda pilih sedang tidak aktif dan tidak dapat menerima pesanan.');
            }

            return view('user.jbi.order', compact('jbi'));
        }


    public function storeOrder(Request $request)
{
    $request->validate([
        'jbi_id' => 'required|exists:jbis,id',
        'nama_pemesan' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'no_hp' => 'required|string|max:20',
        'tanggal' => 'required|date|after_or_equal:today',
        'deskripsi' => 'required|string',
        'jam_awal' => 'required',
        'jam_akhir' => 'required',
    ]);

    $jbi = Jbi::findOrFail($request->jbi_id);

    // Validasi apakah JBI tersedia
    if ($jbi->ketersediaan !== 'Tersedia') {
        return back()->with('error', 'JBI sedang tidak tersedia untuk menerima pesanan.');
    }

    // Validasi tanggal dan hari
    $tanggal_pesan = \Carbon\Carbon::parse($request->tanggal);
    $hari_pesan = $tanggal_pesan->locale('id')->dayName; // Nama hari dalam bahasa Indonesia
    
    // Cek apakah tanggal yang dipilih sudah lewat
    if ($tanggal_pesan->isPast()) {
        return back()->with('error', 'Pemesanan Gagal! Tidak dapat memesan untuk tanggal yang sudah berlalu.');
    }
    
    // Validasi jadwal hari JBI (misal: jadwal berisi "Senin-Jumat" atau "Senin, Rabu, Jumat")
    if ($jbi->jadwal) {
        $jadwal_jbi = strtolower($jbi->jadwal);
        $hari_pesan_lower = strtolower($hari_pesan);
        
        // Mapping hari bahasa Indonesia
        $hari_mapping = [
            'monday' => 'senin', 'tuesday' => 'selasa', 'wednesday' => 'rabu',
            'thursday' => 'kamis', 'friday' => 'jumat', 'saturday' => 'sabtu', 'sunday' => 'minggu'
        ];
        $hari_en = strtolower($tanggal_pesan->format('l'));
        $hari_id = $hari_mapping[$hari_en] ?? $hari_pesan_lower;
        
        // Cek apakah hari tersedia dalam jadwal
        $hari_tersedia = false;
        
        // Check for "Senin-Jumat" or "Senin - Jumat" (with or without spaces)
        if ((strpos($jadwal_jbi, 'senin-jumat') !== false || strpos($jadwal_jbi, 'senin - jumat') !== false) && in_array($hari_id, ['senin', 'selasa', 'rabu', 'kamis', 'jumat'])) {
            $hari_tersedia = true;
        } 
        // Check for "Senin-Sabtu" or "Senin - Sabtu" (with or without spaces)
        elseif ((strpos($jadwal_jbi, 'senin-sabtu') !== false || strpos($jadwal_jbi, 'senin - sabtu') !== false) && in_array($hari_id, ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'])) {
            $hari_tersedia = true;
        } 
        // Check for "Jumat-Minggu" or "Jumat - Minggu" (with or without spaces)
        elseif ((strpos($jadwal_jbi, 'jumat-minggu') !== false || strpos($jadwal_jbi, 'jumat - minggu') !== false) && in_array($hari_id, ['jumat', 'sabtu', 'minggu'])) {
            $hari_tersedia = true;
        }
        // Check for "Selasa & Kamis" or "Selasa&Kamis" format
        elseif ((strpos($jadwal_jbi, 'selasa & kamis') !== false || strpos($jadwal_jbi, 'selasa&kamis') !== false) && in_array($hari_id, ['selasa', 'kamis'])) {
            $hari_tersedia = true;
        }
        // Check for "Senin-Kamis" or "Senin - Kamis" (with or without spaces)
        elseif ((strpos($jadwal_jbi, 'senin-kamis') !== false || strpos($jadwal_jbi, 'senin - kamis') !== false) && in_array($hari_id, ['senin', 'selasa', 'rabu', 'kamis'])) {
            $hari_tersedia = true;
        }
        // Check for "Setiap Hari" format
        elseif (strpos($jadwal_jbi, 'setiap hari') !== false) {
            $hari_tersedia = true;
        }
        // Check if specific day is mentioned in schedule
        elseif (strpos($jadwal_jbi, $hari_id) !== false) {
            $hari_tersedia = true;
        }
        
        if (!$hari_tersedia) {
            return back()->with('error', 'Pemesanan Gagal! JBI tidak tersedia pada hari ' . ucfirst($hari_id) . '. Jadwal tersedia: ' . $jbi->jadwal);
        }
    }

    // Validasi jam kerja JBI untuk semua layanan
    $jam_awal_request = strtotime($request->jam_awal);
    $jam_akhir_request = strtotime($request->jam_akhir);
    
    // Parse jadwal JBI (misal: "09:00-17:00")
    if ($jbi->jam && $jbi->jam_selesai) {
        $jam_mulai_jbi = strtotime($jbi->jam);
        $jam_selesai_jbi = strtotime($jbi->jam_selesai);
        
        // Cek apakah jam awal dan jam akhir dalam rentang jam kerja JBI
        if ($jam_awal_request < $jam_mulai_jbi || $jam_awal_request >= $jam_selesai_jbi) {
            return back()->with('error', 'Pemesanan Gagal! Jam mulai di luar jam kerja JBI. Jam kerja: ' . $jbi->jam . ' - ' . $jbi->jam_selesai);
        }
        
        if ($jam_akhir_request > $jam_selesai_jbi || $jam_akhir_request <= $jam_mulai_jbi) {
            return back()->with('error', 'Pemesanan Gagal! Jam selesai di luar jam kerja JBI. Jam kerja: ' . $jbi->jam . ' - ' . $jbi->jam_selesai);
        }
    }

    // Hitung durasi
    $start = strtotime($request->jam_awal);
    $end = strtotime($request->jam_akhir);
    $durasi_jam = ($end - $start) / 3600;

    // Validasi durasi
    if ($durasi_jam <= 0 || $durasi_jam > 6) {
        return back()->with('error', 'Durasi waktu tidak valid. Minimal 1 jam dan maksimal 6 jam.');
    }

    // Tentukan biaya berdasarkan layanan
    if ($jbi->layanan === 'Gratis') {
        $biaya = 0;
        $status = 'pending'; // Tetap pending, menunggu approval admin
    } else {
        if ($durasi_jam <= 2) {
            $biaya = 150000;
        } elseif ($durasi_jam <= 4) {
            $biaya = 300000;
        } else {
            $biaya = 600000;
        }
        $status = 'pending'; // Perlu pembayaran jika berbayar
    }

    // Simpan ke database
    $pemesanan = Pemesanan::create([
        'jbi_id' => $request->jbi_id,
        'nama_pemesan' => $request->nama_pemesan,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'tanggal' => $request->tanggal,
        'deskripsi' => $request->deskripsi,
        'jam_awal' => $request->jam_awal,
        'jam_akhir' => $request->jam_akhir,
        'durasi_jam' => $durasi_jam,
        'biaya' => $biaya,
        'status' => $status,
    ]);

    // Jika gratis, langsung ke riwayat tanpa proses pembayaran
    if ($jbi->layanan === 'Gratis') {
        return redirect()->route('riwayat.index')
            ->with('success', 'Pemesanan berhasil dibuat! Pesanan Anda sedang menunggu persetujuan admin.');
    }

    // Jika berbayar, ke halaman pembayaran
    return redirect()->route('pembayaran.pembayaran_step1', ['id' => $pemesanan->id])
        ->with('info', 'Silakan lanjutkan proses pembayaran untuk menyelesaikan pemesanan Anda.');
}





        // Tahap 1
    public function step1($id)
        {
            $pemesanan = Pemesanan::findOrFail($id);
            $jbi = $pemesanan->jbi;

            // Jika layanan gratis, langsung redirect ke riwayat
            if ($jbi && $jbi->layanan === 'Gratis') {
                return redirect()->route('riwayat.index')->with('info', 'Layanan gratis tidak memerlukan pembayaran.');
            }

            // Jika status pembayaran masih pending, arahkan kembali ke proses pembayaran
            if ($pemesanan->status === 'pending') {
                return view('pembayaran.pembayaran_step1', compact('id'));
            }

            return redirect()->route('riwayat.index')->with('error', 'Pembayaran sudah selesai atau tidak valid.');
        }

    // Tahap 2
    public function step2(Request $request, $id)
    {
        $request->validate([
            'jenis_metode' => 'required'
        ]);

        return view('pembayaran.pembayaran_step2', [
            'id' => $id,
            'jenis_metode' => $request->jenis_metode
        ]);
    }

    // Show konfirmasi page (GET method)
    public function showKonfirmasi($id)
    {
        $booking = Pemesanan::findOrFail($id);
        $jbi = $booking->jbi;

        // Redirect jika layanan gratis
        if ($jbi && $jbi->layanan === 'Gratis') {
            return redirect()->route('riwayat.index')->with('info', 'Layanan gratis tidak memerlukan pembayaran.');
        }

        // Redirect jika sudah completed
        if ($booking->status !== 'pending') {
            return redirect()->route('riwayat.index')->with('info', 'Pembayaran sudah selesai.');
        }

        return view('pembayaran.pembayaran_konfirmasi', [
            'id' => $id,
            'jenis_metode' => 'bank_transfer', // default
            'metode_detail' => 'Bank Transfer',
            'booking' => $booking
        ]);
    }

    // Konfirmasi & upload
    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'metode_detail' => 'required',
            'jenis_metode' => 'required'
        ]);

        // Simpan ke database jika perlu
        $booking = Pemesanan::findOrFail($id);

         return view('pembayaran.pembayaran_konfirmasi', [
        'id' => $id,
        'jenis_metode' => $request->jenis_metode,
        'metode_detail' => $request->metode_detail,
        'booking' => $booking // ← ini penting
    ]);
    }

    // Upload bukti
    public function uploadBukti(Request $request, $id)
    {
        try {
            \Log::info('Upload bukti called for order: ' . $id);
            
            // Validasi input
            $request->validate([
                'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:10240', // Maksimal 10MB
                'jenis_pembayaran' => 'required|string',
                'metode_pembayaran' => 'required|string',
            ]);

            // Cek apakah file ada
            if (!$request->hasFile('bukti_pembayaran')) {
                \Log::error('No file uploaded for order: ' . $id);
                return back()->with('error', 'File bukti pembayaran wajib diupload.');
            }

            $file = $request->file('bukti_pembayaran');
            
            // Cek apakah file valid
            if (!$file->isValid()) {
                \Log::error('Invalid file uploaded for order: ' . $id);
                return back()->with('error', 'File yang diupload tidak valid. Silakan coba lagi.');
            }

            // Cek ukuran file secara manual sebagai backup
            if ($file->getSize() > 10485760) { // 10MB dalam bytes
                \Log::error('File too large for order: ' . $id . ', size: ' . $file->getSize());
                return back()->with('error', 'Ukuran file terlalu besar. Maksimal 10MB.');
            }

            // Cek ekstensi file
            $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, $allowedExtensions)) {
                \Log::error('Invalid file type for order: ' . $id . ', extension: ' . $extension);
                return back()->with('error', 'Format file tidak didukung. Hanya JPEG, PNG, GIF, atau PDF.');
            }

            // Buat direktori jika belum ada
            $uploadPath = public_path('uploads/bukti_pembayaran');
            if (!file_exists($uploadPath)) {
                if (!mkdir($uploadPath, 0755, true)) {
                    \Log::error('Failed to create upload directory: ' . $uploadPath);
                    return back()->with('error', 'Gagal membuat folder upload. Silakan hubungi admin.');
                }
            }

            // Upload file dengan nama yang aman
            $filename = time() . '_' . $id . '.' . $extension;
            
            if (!$file->move($uploadPath, $filename)) {
                \Log::error('Failed to move file for order: ' . $id);
                return back()->with('error', 'Gagal menyimpan file. Silakan coba lagi.');
            }

            \Log::info('File uploaded successfully: ' . $filename);

            // Simpan/update ke database
            $pemesanan = Pemesanan::findOrFail($id);
            $pemesanan->bukti_pembayaran = $filename;
            $pemesanan->jenis_pembayaran = $request->jenis_pembayaran;
            $pemesanan->metode_pembayaran = $request->metode_pembayaran;
            $pemesanan->status = 'pending'; // Status pending, menunggu approval admin
            $pemesanan->save();

            \Log::info('Payment proof uploaded successfully: ' . $id);
            return redirect()->route('riwayat.index')->with('success', 'Bukti pembayaran berhasil dikirim! Pesanan Anda sedang menunggu verifikasi admin.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error for order: ' . $id . ', errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('File upload error for order: ' . $id . ', error: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengupload file. Error: ' . $e->getMessage());
        }
    }

    // Fungsi untuk melanjutkan pembayaran yang tertinggal
    public function lanjutkanPembayaran($id)
    {
        $pemesanan = Pemesanan::with('jbi')->findOrFail($id);
        
        // Cek apakah pemesanan masih pending dan berbayar
        if ($pemesanan->status === 'pending' && $pemesanan->jbi && $pemesanan->jbi->layanan === 'Berbayar') {
            return redirect()->route('pembayaran.pembayaran_step1', ['id' => $pemesanan->id]);
        }
        
        // Jika sudah completed atau gratis, ke riwayat
        return redirect()->route('riwayat.index')->with('info', 'Pemesanan sudah selesai atau tidak memerlukan pembayaran.');
    }


    private function getNomorByJenis($jenis)
    {
        $data = [
            'dana' => '081234567890',
            'gopay' => '089912345678',
            'seabank' => '1234567890',
        ];
        return $data[$jenis] ?? '-';
    }

    private function hitungBiaya($jam_awal, $jam_akhir)
    {
        $start = \Carbon\Carbon::createFromFormat('H:i', $jam_awal);
        $end = \Carbon\Carbon::createFromFormat('H:i', $jam_akhir);
        $durasi = $start->diffInHours($end);

        if ($durasi <= 2) {
            $biaya = 150000;
        } elseif ($durasi <= 4) {
            $biaya = 300000;
        } elseif ($durasi <= 6) {
            $biaya = 600000;
        } else {
            $biaya = 600000 + ($durasi - 6) * 100000;
        }

        return [$durasi, $biaya];
    }

public function updateJBI(Request $request, $id)
{
    $jbi = Jbi::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'keahlian' => 'required|string|max:255',
        'jk' => 'required|in:Laki-laki,Perempuan',
        'no_hp' => 'required|string|max:20',
        'ketersediaan' => 'required',
        'jadwal' => 'required|string',
        'jam' => 'nullable|string|max:50',
        'jam_selesai' => 'required|string|max:255',
        'alamat' => 'required|string',
        'layanan' => 'required|in:Gratis,Berbayar',
        'status' => 'required|in:aktif,tidak aktif',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // Maksimal 5MB
    ]);

    // Update semua field satu-satu
    $jbi->nama = $request->nama;
    $jbi->keahlian = $request->keahlian;
    $jbi->jk = $request->jk;
    $jbi->no_hp = $request->no_hp;
    $jbi->ketersediaan = $request->ketersediaan;
    $jbi->jadwal = $request->jadwal;
    $jbi->jam = $request->jam;
    $jbi->jam_selesai = $request->jam_selesai;
    $jbi->alamat = $request->alamat;
    $jbi->layanan = $request->layanan;
    $jbi->status = $request->status;

    // Upload foto jika ada
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $filename = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path('uploads/foto_jbi'), $filename);
        $jbi->foto = $filename;
    }
    
    // Simpan semua perubahan
    $jbi->save();

    return redirect()->back()->with('success', 'Data JBI berhasil diperbarui.');
}





}
