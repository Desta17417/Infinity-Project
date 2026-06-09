<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    // Tambahkan atau ubah fungsi ini di MotorController
    public function index()
    {
        $motors = \App\Models\Motor::where('status', 'tersedia')->get();

        // Jika request datang dari URL admin, tampilkan view admin
        if (request()->is('admin/*')) {
            return view('admin.motors.index', compact('motors'));
        }

        // Jika request publik (URL: /katalog)
        return view('motors.index', compact('motors'));
    }
    public function create()
    {
        return view('admin.motors.create');
    }

   public function store(Request $request)
{
    // 1. Validasi data (tambahkan validasi foto)
    $request->validate([
        'nama_motor' => 'required',
        'merk'       => 'required',
        'harga_sewa' => 'required|numeric',
        'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB
    ]);

    // 2. Ambil semua data input kecuali foto dulu
    $data = $request->all();

    // 3. Logika Upload Gambar
    if ($request->hasFile('foto')) {
        // Simpan file ke folder 'motors' di disk 'public'
        // Ini akan menghasilkan path seperti: motors/namafile.png
        $path = $request->file('foto')->store('motors', 'public');
        
        // Simpan path tersebut ke dalam array data
        $data['foto'] = $path;
    }

    // 4. Simpan ke database
    \App\Models\Motor::create($data);

    // 5. Redirect
    return redirect()->route('admin.motors.index')->with('success', 'Data motor dan foto berhasil ditambahkan!');
}
    public function show($id)
    {
        $motor = \App\Models\Motor::findOrFail($id);
        return view('admin.motors.show', compact('motor'));
    }

    // 1. Fungsi untuk menampilkan formulir edit
    public function edit($id)
    {
        // Mencari data motor berdasarkan ID
        $motor = \App\Models\Motor::findOrFail($id);

        // Mengarahkan ke file view edit yang ada di folder admin/motors
        return view('admin.motors.edit', compact('motor'));
    }

    // 2. Fungsi untuk memproses perubahan data ke database
public function update(Request $request, $id)
{
    $motor = \App\Models\Motor::findOrFail($id);

    $request->validate([
        'nama_motor' => 'required',
        'merk' => 'required',
        'harga_sewa' => 'required|numeric',
        'foto' => 'nullable|image|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada (opsional tapi disarankan agar storage tidak penuh)
        if ($motor->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($motor->foto);
        }
        
        // Simpan foto baru
        $data['foto'] = $request->file('foto')->store('motors', 'public');
    } else {
        // Jika tidak upload foto baru, tetap gunakan path foto yang lama
        unset($data['foto']);
    }

    $motor->update($data);

    return redirect()->route('admin.motors.index')->with('success', 'Data berhasil diperbarui!');
}

    public function destroy($id)
    {
        Motor::find($id)->delete();
        return back();
    }
}
