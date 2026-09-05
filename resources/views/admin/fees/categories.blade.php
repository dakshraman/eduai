@extends('layouts.app')

@section('title', 'Fee Categories')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-900">Fee Categories</h1>

    {{-- Add form --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h3 class="text-sm font-semibold text-gray-900 mb-3">Add Fee Category</h3>
        <form method="POST" action="{{ route('fee-categories.store') }}" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="name" placeholder="Category name" required
                   class="flex-1 max-w-xs px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-[#BFECFF] focus:ring-2 focus:ring-[#BFECFF]/30 transition @error('name') border-red-500 @enderror">
            <input type="text" name="description" placeholder="Description (optional)"
                   class="flex-1 max-w-sm px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-[#BFECFF] focus:ring-2 focus:ring-[#BFECFF]/30 transition @error('description') border-red-500 @enderror">
            <button type="submit" class="px-4 py-2 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-medium rounded-lg transition">Add Category</button>
        </form>
        @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    {{-- List --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#FFF6E3]/50 border-b border-[#BFECFF]/20">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Name</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Description</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories ?? [] as $category)
                        <tr class="hover:bg-[#FFF6E3] transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $category->name }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $category->description ?? '-' }}</td>
                            <td class="px-5 py-3 text-right">
                                <form method="POST" action="{{ route('fee-categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-12 text-center text-gray-400">No fee categories yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
