<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MotorController extends Controller
{
    public function index()
    {
        $motors = Motor::latest()->get();
        return view('admin.motors.index', compact('motors'));
    }

    public function create()
    {
        return view('admin.motors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required',
            'merk'       => 'required',
            'harga_sewa' => 'required|numeric',
            'status'     => 'required',
            'foto'       => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('motors', 'public');
        }

        Motor::create($data);
        return redirect()->route('admin.motors.index')->with('success', 'Motor berhasil ditambahkan');
    }

    public function edit(Motor $motor)
    {
        return view('admin.motors.edit', compact('motor'));
    }

    public function update(Request $request, Motor $motor)
    {
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($motor->foto) Storage::disk('public')->delete($motor->foto);
            $data['foto'] = $request->file('foto')->store('motors', 'public');
        }

        $motor->update($data);
        return redirect()->route('admin.motors.index')->with('success', 'Data motor berhasil diperbarui');
    }

    public function destroy(Motor $motor)
    {
        if ($motor->foto) Storage::disk('public')->delete($motor->foto);
        $motor->delete();
        return redirect()->route('admin.motors.index')->with('success', 'Motor berhasil dihapus');
    }
}