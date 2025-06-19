<?php

namespace App\Http\Controllers;
use App\Models\Jbi;
use App\Models\Pemesanan;


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

        // Kalau bukan admin (user biasa), baru pakai filter
        $query = Jbi::query();

        // Filter pencarian nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori (misalnya JBI tuli/dengar/mentor)
        if ($request->filled('kategori')) {
            $query->where('keahlian', $request->kategori); // Pastikan nama kolomnya benar
        }

        $jbis = $query->get();
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
        'alamat' => 'required|string',
        'layanan' => 'required|in:Gratis,Berbayar',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
        'alamat' => $validated['alamat'],
        'layanan' => $validated['layanan'],
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
        ]);

        $jbi->update($request->all());

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

            return view('user.jbi.order', compact('jbi'));
        }


    public function storeOrder(Request $request)
{
    $request->validate([
        'jbi_id' => 'required|exists:jbis,id',
        'nama_pemesan' => 'required|string|max:255',
        'email' => 'nullable|email',
        'no_hp' => 'nullable|string|max:20',
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string',
        'jam_awal' => 'required',
        'jam_akhir' => 'required',
    ]);

    $jbi = Jbi::findOrFail($request->jbi_id);

    // Hitung durasi
    $start = strtotime($request->jam_awal);
    $end = strtotime($request->jam_akhir);
    $durasi_jam = ($end - $start) / 3600;

    // Validasi durasi
    if ($durasi_jam <= 0 || $durasi_jam > 6) {
        return back()->withErrors(['Durasi waktu tidak valid']);
    }

    // Tentukan biaya berdasarkan layanan
    if ($jbi->layanan === 'Gratis') {
        $biaya = 0;
    } else {
        if ($durasi_jam <= 2) {
            $biaya = 150000;
        } elseif ($durasi_jam <= 4) {
            $biaya = 300000;
        } else {
            $biaya = 600000;
        }
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
        'status' => 'pending',
    ]);

    // Redirect ke halaman pembayaran step 1
    return redirect()->route('pembayaran.pembayaran_step1', ['id' => $pemesanan->id]);
}





        // Tahap 1
    public function step1($id)
        {
            return view('pembayaran.pembayaran_step1', compact('id'));
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
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_pembayaran' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        // Upload file
        $file = $request->file('bukti_pembayaran');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti_pembayaran'), $filename);

        // Simpan/update ke database
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->bukti_pembayaran = $filename;
        $pemesanan->jenis_pembayaran = $request->jenis_pembayaran;
        $pemesanan->metode_pembayaran = $request->metode_pembayaran;
        $pemesanan->save();

        return redirect()->route('user.dashboard')->with('success', 'Bukti pembayaran berhasil dikirim.');
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
        'alamat' => 'required|string',
        'layanan' => 'required|in:Gratis,Berbayar',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update semua field satu-satu
    $jbi->nama = $request->nama;
    $jbi->keahlian = $request->keahlian;
    $jbi->jk = $request->jk;
    $jbi->no_hp = $request->no_hp;
    $jbi->ketersediaan = $request->ketersediaan;
    $jbi->jadwal = $request->jadwal;
    $jbi->alamat = $request->alamat;
    $jbi->layanan = $request->layanan;

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
