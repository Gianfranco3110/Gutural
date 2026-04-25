<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    public function index(): View
    {
        $maintenanceMode = Setting::get('maintenance_mode', '0') === '1';
        $maintenanceImage = Setting::get('maintenance_image');

        return view('admin.maintenance.index', compact('maintenanceMode', 'maintenanceImage'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'maintenance_mode' => ['nullable', 'boolean'],
            'maintenance_image' => ['nullable', 'image', 'max:5120'],
        ]);

        // Update maintenance mode
        Setting::set('maintenance_mode', $request->boolean('maintenance_mode') ? '1' : '0');

        // Handle image upload
        if ($request->hasFile('maintenance_image')) {
            // Delete old image
            $oldImage = Setting::get('maintenance_image');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            // Store new image
            $path = $request->file('maintenance_image')->store('maintenance', 'public');
            Setting::set('maintenance_image', $path);
        }

        return back()->with('success', 'Configuración de mantenimiento actualizada.');
    }
}
