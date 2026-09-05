@extends('layouts.app')

@section('title', 'Invoices')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Invoices</h1>
        <a href="{{ route('billing.index') }}" class="text-sm text-[#CDC1FF] hover:text-[#b5a8e8] font-medium">
            &larr; Back to Billing
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        @if(empty($invoices))
            <div class="text-center py-12">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
                <p class="text-gray-500 text-sm">Invoice history will appear here after your first payment.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Date</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Description</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Amount</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-500">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr class="border-b border-gray-100">
                                <td class="py-3 px-4">{{ $invoice['date'] }}</td>
                                <td class="py-3 px-4">{{ $invoice['description'] }}</td>
                                <td class="py-3 px-4">${{ number_format($invoice['amount'], 2) }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $invoice['status'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
