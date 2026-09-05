<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter',
                'slug' => 'starter',
                'description' => 'Perfect for small schools getting started.',
                'price_monthly' => 29,
                'price_yearly' => 290,
                'features' => ['Up to 200 students', '5 teacher accounts', 'All core features', 'Email support'],
                'active_status' => true,
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'description' => 'For growing schools with more needs.',
                'price_monthly' => 79,
                'price_yearly' => 790,
                'features' => ['Up to 1,000 students', '25 teacher accounts', 'All features + reports', 'Priority support', 'Custom branding'],
                'active_status' => true,
            ],
            [
                'name' => 'School',
                'slug' => 'school',
                'description' => 'For large institutions with full needs.',
                'price_monthly' => 199,
                'price_yearly' => 1990,
                'features' => ['Unlimited students', 'Unlimited teachers', 'All features + API', 'Dedicated support', 'On-premise option'],
                'active_status' => true,
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::updateOrCreate(['slug' => $plan['slug']], $plan);
        }
    }
}
