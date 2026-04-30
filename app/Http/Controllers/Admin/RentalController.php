<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        // Mengambil semua data rental dengan relasi motor dan user
        $rentals = Rental::with(['motor', 'user'])->latest()->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    public function updateStatus(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);
        $rental->status = $request->status; // misal: 'lunas', 'selesai', 'dibatalkan'
        $rental->save();

        return back()->with('success', 'Status rental berhasil diubah');
    }

    public function show($id)
    {
        $rental = Rental::with(['motor', 'user'])->findOrFail($id);
        return view('admin.rentals.show', compact('rental'));
    }
}