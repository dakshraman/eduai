@extends('layouts.app')

@section('title', 'Billing')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Current Subscription --}}
    @if($subscription)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Current Subscription</h2>
                @if($subscription->isTrial())
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        Trial
                    </span>
                @elseif($subscription->isActive())
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Active
                    </span>
                @elseif($subscription->status === 'cancelled')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                        Cancelled
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        {{ ucfirst($subscription->status) }}
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <p class="text-sm text-gray-500">Plan</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $subscription->plan->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Billing Period</p>
                    <p class="text-lg font-semibold text-gray-900">{{ ucfirst($subscription->billing_period) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">
                        {{ $subscription->isTrial() ? 'Trial Ends' : 'Next Billing Date' }}
                    </p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ ($subscription->current_period_end ?? $subscription->trial_ends_at)?->format('M d, Y') ?? 'N/A' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Price</p>
                    <p class="text-lg font-semibold text-gray-900">
                        ${{ number_format($subscription->plan->price_monthly ?? 0, 2) }}/mo
                    </p>
                </div>
            </div>

            @if($subscription->isTrial() && $subscription->trial_ends_at)
                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-700">
                        Your free trial ends in <strong>{{ $subscription->trial_ends_at->diffForHumans() }}</strong>.
                        Choose a plan below to continue using all features.
                    </p>
                </div>
            @endif

            @if($subscription->isActive() || $subscription->isTrial())
                <div class="mt-6 flex gap-3">
                    <form method="POST" action="{{ route('billing.cancel') }}">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to cancel your subscription?')"
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium table-row-hover-colors">
                            Cancel Subscription
                        </button>
                    </form>
                    <a href="{{ route('billing.invoices') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium table-row-hover-colors">
                        View Invoices
                    </a>
                </div>
            @endif
        </div>
    @else
        <div class="bg-gradient-to-r from-[#BFECFF] to-[#CDC1FF] rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="text-lg font-semibold">14-Day Free Trial</h2>
            </div>
            <p class="text-[#1e293b]/70">You're currently on a free trial. Choose a plan below to keep access after your trial ends.</p>
        </div>
    @endif

    {{-- Plans --}}
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Choose Your Plan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($plans as $plan)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col
                            {{ $subscription && $subscription->subscription_plan_id === $plan->id ? 'ring-2 ring-[#CDC1FF]' : '' }}">
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-900">{{ $plan->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $plan->description }}</p>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-gray-900">${{ number_format($plan->price_monthly, 0) }}</span>
                            <span class="text-gray-500">/mo</span>
                        </div>
                        @if($plan->price_yearly)
                            <p class="text-sm text-green-600 mt-1">
                                ${{ number_format($plan->price_yearly, 0) }}/year — save ${{ number_format($plan->price_monthly * 12 - $plan->price_yearly, 0) }}
                            </p>
                        @endif
                    </div>

                    <ul class="space-y-3 mb-6 flex-1">
                        @foreach($plan->features ?? [] as $feature)
                            <li class="flex items-start gap-2 text-sm text-gray-700">
                                <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>

                    @if($subscription && $subscription->subscription_plan_id === $plan->id && $subscription->isActive())
                        <div class="px-4 py-2.5 bg-green-50 text-green-700 rounded-lg text-sm font-medium text-center">
                            Current Plan
                        </div>
                    @else
                        <form method="POST" action="{{ route('billing.subscribe') }}">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                            <div class="flex gap-2">
                                <button type="submit" name="billing_period" value="monthly"
                                        class="flex-1 px-4 py-2.5 bg-[#BFECFF]/200 text-[#1e293b] rounded-lg text-sm font-medium hover:bg-primary-600 transition-colors">
                                    Monthly
                                </button>
                                @if($plan->price_yearly)
                                    <button type="submit" name="billing_period" value="yearly"
                                            class="flex-1 px-4 py-2.5 border border-[#CDC1FF] text-[#CDC1FF] rounded-lg text-sm font-medium hover:bg-[#BFECFF]/20 transition-colors">
                                        Yearly
                                    </button>
                                @endif
                            </div>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
