@extends('layouts.app')

@section('title', 'Create Exam')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('exams.index') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Create Exam</h1>
    </div>

    <form method="POST" action="{{ route('exams.store') }}" class="space-y-6">
        @csrf
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Exam Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('name') border-red-500 @enderror">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Class *</label>
                <select name="class_id" required class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('class_id') border-red-500 @enderror">
                    <option value="">Select Class</option>
                    @foreach($classes ?? [] as $class)
                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
                @error('class_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('start_date') border-red-500 @enderror">
                    @error('start_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date *</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('end_date') border-red-500 @enderror">
                    @error('end_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Exam Type</label>
                <select name="exam_type" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                    <option value="midterm" {{ old('exam_type') === 'midterm' ? 'selected' : '' }}>Midterm</option>
                    <option value="final" {{ old('exam_type') === 'final' ? 'selected' : '' }}>Final</option>
                    <option value="quarterly" {{ old('exam_type') === 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                    <option value="unit_test" {{ old('exam_type') === 'unit_test' ? 'selected' : '' }}>Unit Test</option>
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">Create Exam</button>
            <a href="{{ route('exams.index') }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
