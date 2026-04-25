<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $maintenanceMode = Setting::get('maintenance_mode', '0') === '1';
        
        // Si está en modo mantenimiento y no es admin
        if ($maintenanceMode && (!Auth::check() || !Auth::user()->is_admin)) {
            $maintenanceImage = Setting::get('maintenance_image');
            return response()->view('maintenance', compact('maintenanceImage'));
        }

        return $next($request);
    }
}
