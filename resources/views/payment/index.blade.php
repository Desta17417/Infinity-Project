@extends('layouts.frontend')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="text-center mb-8">
        <h3 class="text-slate-400 uppercase tracking-widest text-xs font-bold mb-2">Instruksi Pembayaran</h3>
        <p class="text-slate-500 mb-1">Total yang harus dibayar:</p>
        <h1 class="text-3xl font-extrabold text-slate-800">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</h1>
        <div class="inline-flex items-center gap-2 text-amber-600 bg-amber-50 px-3 py-1 rounded-full text-sm font-medium mt-3">
            <i class="far fa-clock"></i> Menunggu Pembayaran
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-8">
        <div class="p-8 text-center border-b border-slate-100">
            <p class="text-slate-500 text-sm font-medium mb-4">Silakan Transfer Ke:</p>
            
            <div class="flex justify-center mb-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="Logo BCA" class="h-16">
            </div>
            
            <div class="space-y-1">
                <p class="text-2xl font-mono font-bold tracking-wider text-slate-800">1234 5678 90</p>
                <p class="text-slate-500 uppercase text-xs tracking-widest font-bold">Atas Nama: PT RentRide Indonesia</p>
            </div>
        </div>

        <div class="bg-slate-50 p-6 space-y-4">
            <h4 class="text-slate-800 font-bold text-sm uppercase tracking-wider border-b border-slate-200 pb-2">Ringkasan Pesanan:</h4>
            <div class="grid grid-cols-2 gap-y-2 text-sm">
                <span class="text-slate-500">Unit Motor:</span>
                <span class="text-slate-800 font-semibold text-right">{{ $rental->motor->nama_motor }}</span>
                
                <span class="text-slate-500">Penyewa:</span>
                <span class="text-slate-800 font-semibold text-right">{{ Auth::user()->name ?? 'Pelanggan' }}</span>
                
                <span class="text-slate-500">Tanggal Sewa:</span>
                <span class="text-slate-800 font-semibold text-right">{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}</span>
            </div>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="https://wa.me/628123456789?text=Halo%20Admin%2C%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20sewa%20motor%20{{ $rental->motor->nama_motor }}" 
           target="_blank"
           class="w-full sm:w-auto flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg shadow-emerald-200">
            <i class="fab fa-whatsapp text-xl"></i>
            Konfirmasi via WhatsApp
        </a>
        
        <a href="{{ route('motors.index') }}" class="text-slate-400 hover:text-blue-600 font-semibold text-sm transition-colors">
            Kembali ke Katalog <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>
@endsection