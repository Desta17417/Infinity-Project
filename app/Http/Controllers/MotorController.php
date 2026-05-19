<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // 1. Validasi data
        $request->validate([
            'nama_motor' => 'required|string|max:100',
            'merk'       => 'required|string|max:50',
            'harga_sewa' => 'required|numeric|min:0',
            'status'     => 'nullable|in:tersedia,disewa',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // Maksimal 5MB
        ], [
            'foto.max' => 'Ukuran foto terlalu besar. Maksimal 5MB. File akan otomatis dikompres.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.image' => 'File yang diupload harus berupa gambar.',
        ]);

        // 2. Persiapan data
        $data = $request->only(['nama_motor', 'merk', 'harga_sewa', 'status']);
        $data['status'] = $data['status'] ?? 'tersedia';

        // 3. Handle upload dan kompresi foto
        if ($request->hasFile('foto')) {
            try {
                $fotoPath = ImageCompressionService::compressAndStore(
                    $request->file('foto'),
                    'motors',
                    1200, // Max width
                    75    // Quality (75%)
                );
                $data['foto'] = $fotoPath;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal memproses foto: ' . $e->getMessage());
            }
        }

        // 4. Simpan ke database
        Motor::create($data);

        return redirect()->route('admin.motors.index')
            ->with('success', 'Data motor berhasil ditambahkan!');
    }

    public function show($id)
    {
        $motor = \App\Models\Motor::findOrFail($id);
        return view('admin.motors.show', compact('motor'));
    }

    // Fungsi untuk menampilkan formulir edit
    public function edit($id)
    {
        $motor = \App\Models\Motor::findOrFail($id);
        return view('admin.motors.edit', compact('motor'));
    }

    // Fungsi untuk memproses perubahan data ke database
    public function update(Request $request, $id)
    {
        $motor = \App\Models\Motor::findOrFail($id);

        // Validasi
        $request->validate([
            'nama_motor' => 'required|string|max:100',
            'merk'       => 'required|string|max:50',
            'harga_sewa' => 'required|numeric|min:0',
            'status'     => 'nullable|in:tersedia,disewa',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120', // Maksimal 5MB
        ], [
            'foto.max' => 'Ukuran foto terlalu besar. Maksimal 5MB. File akan otomatis dikompres.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.image' => 'File yang diupload harus berupa gambar.',
        ]);

        // Persiapan data
        $data = $request->only(['nama_motor', 'merk', 'harga_sewa', 'status']);
        $data['status'] = $data['status'] ?? 'tersedia';

        // Handle upload foto baru (opsional)
        if ($request->hasFile('foto')) {
            try {
                // Hapus foto lama jika ada
                if ($motor->foto) {
                    ImageCompressionService::deleteImage($motor->foto);
                }

                // Simpan foto baru dengan kompresi
                $fotoPath = ImageCompressionService::compressAndStore(
                    $request->file('foto'),
                    'motors',
                    1200, // Max width
                    75    // Quality (75%)
                );
                $data['foto'] = $fotoPath;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal memproses foto: ' . $e->getMessage());
            }
        }

        // Update motor
        $motor->update($data);

        return redirect()->route('admin.motors.index')
            ->with('success', 'Data motor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $motor = Motor::findOrFail($id);
        
        // Hapus foto jika ada
        if ($motor->foto) {
            ImageCompressionService::deleteImage($motor->foto);
        }
        
        $motor->delete();
        
        return redirect()->route('admin.motors.index')
            ->with('success', 'Motor berhasil dihapus!');
    }
}
