@extends('layouts.app')

@section('title', 'Fee Structures')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-900">Fee Structures</h1>

    {{-- Add form --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h3 class="text-sm font-semibold text-gray-900 mb-3">Add Fee Structure</h3>
        <form method="POST" action="{{ route('fee-structures.store') }}" class="space-y-3">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                <select name="class_id" required class="px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                    <option value="">Select Class</option>
                    @foreach($classes ?? [] as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                <select name="fee_category_id" required class="px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                    <option value="">Select Category</option>
                    @foreach($feeCategories ?? [] as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="amount" placeholder="Amount" step="0.01" required
                       class="px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">Add Structure</button>
            </div>
        </form>
    </div>

    {{-- List --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Class</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Fee Category</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Amount</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($structures ?? [] as $structure)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $structure->class->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $structure->feeCategory->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ number_format($structure->amount, 2) }}</td>
                            <td class="px-5 py-3 text-right">
                                <form method="POST" action="{{ route('fee-structures.destroy', $structure) }}" onsubmit="return confirm('Delete?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-gray-400">No fee structures yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
