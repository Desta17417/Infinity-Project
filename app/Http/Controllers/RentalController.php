<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Motor;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Menampilkan daftar rental untuk sisi Admin.
     */
    public function index()
    {
        $rentals = Rental::with(['user', 'motor'])->latest()->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    /**
     * Menampilkan form pemesanan untuk User.
     */
    public function create($id)
    {
        $motor = Motor::findOrFail($id);
        return view('rental.create', compact('motor'));
    }

    /**
     * Menyimpan data pemesanan ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'motor_id' => 'required|exists:motors,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
        ]);

        $motor = Motor::findOrFail($request->motor_id);

        // Menghitung durasi hari
        $tglSewa = new \DateTime($request->tanggal_sewa);
        $tglKembali = new \DateTime($request->tanggal_kembali);
        $durasi = $tglSewa->diff($tglKembali)->days;
        if ($durasi <= 0) $durasi = 1;

        $totalHarga = $durasi * $motor->harga_sewa;

        $rental = Rental::create([
            'motor_id'      => $request->motor_id,
            'user_id'       => Auth::id(), // Pastikan user sudah login
            'tanggal_sewa'  => $request->tanggal_sewa,
            'tanggal_kembali'=> $request->tanggal_kembali,
            'total_harga'   => $totalHarga,
            'status'        => 'pending',
        ]);

        // Redirect ke route payment.index yang sudah kita daftarkan di web.php
        return redirect()->route('payment.index', $rental->id)
                         ->with('success', 'Pemesanan berhasil dibuat!');
    }

    /**
     * Menampilkan halaman instruksi pembayaran.
     */
public function payment($id)
{
    $rental = Rental::with('motor')->findOrFail($id);
    // Pastikan file ini ada di resources/views/payment/index.blade.php
    // Dan BUKAN resources/views/admin/payment/index.blade.php
    return view('payment.index', compact('rental'));
}
    /**
     * Memproses konfirmasi pembayaran dari User.
     */
    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required',
        ]);

        $rental = Rental::findOrFail($id);

        Payment::create([
            'rental_id' => $rental->id,
            'metode'    => $request->metode_pembayaran,
            'status'    => 'pending',
        ]);

        // Update status rental menjadi confirmed (menunggu verifikasi admin)
        $rental->update(['status' => 'confirmed']);

        return redirect()->route('home')->with('success', 'Pembayaran sedang diverifikasi!');
    }

    /**
     * Admin: Mengubah status sewa (misal: Selesai atau Batal).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai,batal'
        ]);

        $rental = Rental::findOrFail($id);
        $rental->update(['status' => $request->status]);

        return redirect()->route('admin.rentals.index')->with('success', 'Status diperbarui!');
    }

    /**
     * Opsional: Menampilkan detail spesifik pembayaran/struk.
     */
    public function show($id)
    {
        $rental = Rental::with(['motor', 'user'])->findOrFail($id);
        $no_rekening = "123-456-7890 (Bank BCA a/n RentRide)";

        return view('payment.show', compact('rental', 'no_rekening'));
    }
}