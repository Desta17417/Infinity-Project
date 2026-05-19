<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminAccessLog;
use Illuminate\Http\Request;

class AdminLogController extends Controller
{
    /**
     * Tampilkan daftar admin access logs
     */
    public function index(Request $request)
    {
        $query = AdminAccessLog::with('user');

        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('accessed_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('accessed_at', '<=', $request->date_to);
        }

        // Filter berdasarkan action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter berdasarkan admin
        if ($request->filled('admin_id')) {
            $query->where('user_id', $request->admin_id);
        }

        // Urutkan dari terbaru
        $logs = $query->orderBy('accessed_at', 'desc')->paginate(20);

        // Dapatkan daftar admin untuk filter
        $admins = \App\Models\User::where('role', 'admin')->get();

        // Dapatkan daftar action unik
        $actions = AdminAccessLog::distinct()->pluck('action')->toArray();

        return view('admin.logs.index', compact('logs', 'admins', 'actions'));
    }

    /**
     * Tampilkan detail log
     */
    public function show($id)
    {
        $log = AdminAccessLog::findOrFail($id);
        return view('admin.logs.show', compact('log'));
    }

    /**
     * Hapus log (hanya untuk super admin atau tertentu)
     */
    public function destroy($id)
    {
        $log = AdminAccessLog::findOrFail($id);
        $log->delete();

        return redirect()->route('admin.logs.index')
            ->with('success', 'Log berhasil dihapus');
    }

    /**
     * Hapus semua log yang lebih dari 30 hari
     */
    public function clearOldLogs()
    {
        $thirtyDaysAgo = now()->subDays(30);
        $deletedCount = AdminAccessLog::where('accessed_at', '<', $thirtyDaysAgo)->delete();

        return redirect()->route('admin.logs.index')
            ->with('success', "Log lama ($deletedCount records) berhasil dihapus");
    }

    /**
     * Export logs ke CSV
     */
    public function export(Request $request)
    {
        $query = AdminAccessLog::with('user');

        if ($request->filled('date_from')) {
            $query->whereDate('accessed_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('accessed_at', '<=', $request->date_to);
        }

        $logs = $query->orderBy('accessed_at', 'desc')->get();

        $csvFileName = 'admin_access_logs_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = array(
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('ID', 'Admin', 'Action', 'IP Address', 'Accessed At');

        $callback = function() use($logs, $columns) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($file, $columns);

            foreach ($logs as $log) {
                fputcsv($file, array(
                    $log->id,
                    $log->admin_name,
                    $log->action,
                    $log->ip_address,
                    $log->accessed_at->format('Y-m-d H:i:s'),
                ));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
