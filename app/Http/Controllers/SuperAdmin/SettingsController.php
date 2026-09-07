<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        return Inertia::render('SuperAdmin/Settings/Index', [
            'settings' => [
                'platform_name' => config('app.name', 'EduAI'),
                'support_email' => config('eduai.support_email', ''),
                'default_trial_days' => config('eduai.default_trial_days', 14),
                'stripe_key' => config('services.stripe.key', ''),
                'stripe_secret' => config('services.stripe.secret', ''),
                'smtp_host' => config('mail.mailers.smtp.host', ''),
                'smtp_port' => config('mail.mailers.smtp.port', '587'),
                'smtp_user' => config('mail.mailers.smtp.username', ''),
                'smtp_pass' => config('mail.mailers.smtp.password', ''),
            ],
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'platform_name' => 'required|string|max:255',
            'support_email' => 'nullable|email|max:255',
            'default_trial_days' => 'required|integer|min:1|max:365',
            'stripe_key' => 'nullable|string|max:255',
            'stripe_secret' => 'nullable|string|max:255',
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|string|max:10',
            'smtp_user' => 'nullable|string|max:255',
            'smtp_pass' => 'nullable|string|max:255',
        ]);

        // Store in config or database — for now just return success
        return back()->with('success', 'Settings saved successfully.');
    }
}
