<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    public function general()
    {
        return view('admin.settings.general', [
            'settings' => Setting::pluck('value', 'key')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'app_name'       => 'required|string',
            'app_url'        => 'required|url',
            'support_email'  => 'nullable|email',
            'support_phone'  => 'nullable|string',
            'logo'           => 'nullable|image|mimes:png,jpg,jpeg',
            'favicon'        => 'nullable|image|mimes:png,ico',
        ]);

        // Save normal settings
        foreach ($request->except('_token','logo','favicon') as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value]
            );
        }

        // Logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('branding', 'public');
            Setting::updateOrCreate(['key'=>'logo'], ['value'=>$path]);
        }

        // Favicon upload
        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('branding', 'public');
            Setting::updateOrCreate(['key'=>'favicon'], ['value'=>$path]);
        }

        // Maintenance Mode
        if ($request->maintenance_mode) {
            Artisan::call('down');
        } else {
            Artisan::call('up');
        }

        return response()->json([
            'status'  => true,
            'message' => 'General settings updated successfully'
        ]);
    }
}
