@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('teachers.index') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Teacher</h1>
    </div>

    <form method="POST" action="{{ route('teachers.update', $teacher) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        {{-- Personal Info --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3">Personal Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name', $teacher->name) }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('name') border-red-500 @enderror">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $teacher->email) }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('email') border-red-500 @enderror">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-gray-400 font-normal">(leave blank to keep current)</span></label>
                    <input type="password" name="password"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('password') border-red-500 @enderror">
                    @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('phone') border-red-500 @enderror">
                    @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select name="gender" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        <option value="">Select</option>
                        <option value="male" {{ old('gender', $teacher->gender) === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $teacher->gender) === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $teacher->gender) === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob', $teacher->dob) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('dob') border-red-500 @enderror">
                    @error('dob') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
                    <input type="file" name="avatar" accept="image/*"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('avatar') border-red-500 @enderror">
                    @error('avatar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Teacher Info --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3">Teacher Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employee ID *</label>
                    <input type="text" name="employee_id" value="{{ old('employee_id', $teacher->employee_id) }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('employee_id') border-red-500 @enderror">
                    @error('employee_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                    <input type="text" name="designation" value="{{ old('designation', $teacher->designation) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('designation') border-red-500 @enderror">
                    @error('designation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                    <input type="text" name="department" value="{{ old('department', $teacher->department) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('department') border-red-500 @enderror">
                    @error('department') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Joining Date</label>
                    <input type="date" name="joining_date" value="{{ old('joining_date', $teacher->joining_date) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('joining_date') border-red-500 @enderror">
                    @error('joining_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                    <input type="number" name="salary" value="{{ old('salary', $teacher->salary) }}" step="0.01"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('salary') border-red-500 @enderror">
                    @error('salary') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Qualification</label>
                    <input type="text" name="qualification" value="{{ old('qualification', $teacher->qualification) }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('qualification') border-red-500 @enderror">
                    @error('qualification') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
                    <textarea name="experience" rows="3"
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('experience') border-red-500 @enderror">{{ old('experience', $teacher->experience) }}</textarea>
                    @error('experience') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">Update Teacher</button>
            <a href="{{ route('teachers.index') }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
