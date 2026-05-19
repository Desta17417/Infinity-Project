<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminAccessLog;
use Symfony\Component\HttpFoundation\Response;

class LogAdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Catat akses admin jika user terautentikasi dan merupakan admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            try {
                $action = $this->determineAction($request);
                
                AdminAccessLog::create([
                    'user_id' => Auth::id(),
                    'admin_name' => Auth::user()->name,
                    'action' => $action,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'accessed_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Jika ada error saat logging, jangan batalkan request
                \Log::error('Admin access log error: ' . $e->getMessage());
            }
        }

        return $response;
    }

    /**
     * Tentukan aksi berdasarkan route
     */
    private function determineAction(Request $request): string
    {
        $route = $request->route()?->uri ?? $request->path();
        
        if (strpos($route, 'admin/dashboard') !== false) {
            return 'dashboard';
        } elseif (strpos($route, 'admin/motors') !== false) {
            return 'motors';
        } elseif (strpos($route, 'admin/rentals') !== false) {
            return 'rentals';
        } elseif (strpos($route, 'admin/payments') !== false) {
            return 'payments';
        } elseif (strpos($route, 'admin/access-logs') !== false) {
            return 'access_logs';
        }

        return 'other';
    }
}
