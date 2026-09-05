@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<div class="space-y-6 animate-fade-in-up">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Add Student</h1>
            <p class="text-muted-foreground">Add a new student to the system</p>
        </div>
        <x-ui.button variant="outline" href="{{ route('students.index') }}">Cancel</x-ui.button>
    </div>

    <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Personal Information</x-ui.card-title>
                </x-ui.card-header>
                <x-ui.card-content class="space-y-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Full Name *</label>
                        <x-ui.input name="name" value="{{ old('name') }}" placeholder="Enter full name" />
                        @error('name') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Email *</label>
                        <x-ui.input type="email" name="email" value="{{ old('email') }}" placeholder="student@email.com" />
                        @error('email') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Password *</label>
                        <x-ui.input type="password" name="password" placeholder="••••••••" />
                        @error('password') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Phone</label>
                        <x-ui.input name="phone" value="{{ old('phone') }}" placeholder="Phone number" />
                        @error('phone') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Gender</label>
                            <x-ui.select name="gender" placeholder="Select gender" :options="['male' => 'Male', 'female' => 'Female', 'other' => 'Other']" :value="old('gender')" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Date of Birth</label>
                            <x-ui.input type="date" name="dob" value="{{ old('dob') }}" />
                            @error('dob') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Blood Group</label>
                            <x-ui.select name="blood_group" placeholder="Select" :options="['A+','A-','B+','B-','AB+','AB-','O+','O-']" :value="old('blood_group')" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Religion</label>
                            <x-ui.input name="religion" value="{{ old('religion') }}" placeholder="Religion" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Avatar</label>
                        <x-ui.input type="file" name="avatar" />
                        @error('avatar') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </x-ui.card-content>
            </x-ui.card>

            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Student Information</x-ui.card-title>
                </x-ui.card-header>
                <x-ui.card-content class="space-y-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Class *</label>
                        <x-ui.select name="class_id" placeholder="Select class" :options="$classes->pluck('name','id')->toArray()" :value="old('class_id')" />
                        @error('class_id') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Section</label>
                        <x-ui.input name="section" value="{{ old('section') }}" placeholder="Section" />
                        @error('section') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Admission Number *</label>
                        <x-ui.input name="admission_number" value="{{ old('admission_number') }}" placeholder="Admission number" />
                        @error('admission_number') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Roll Number</label>
                        <x-ui.input name="roll_number" value="{{ old('roll_number') }}" placeholder="Roll number" />
                        @error('roll_number') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Admission Date</label>
                        <x-ui.input type="date" name="admission_date" value="{{ old('admission_date', date('Y-m-d')) }}" />
                        @error('admission_date') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Session Year</label>
                        <x-ui.input name="session_year" value="{{ old('session_year', date('Y')) }}" placeholder="Session year" />
                        @error('session_year') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </x-ui.card-content>
                <x-ui.card-footer class="flex justify-end gap-2">
                    <x-ui.button variant="outline" href="{{ route('students.index') }}">Cancel</x-ui.button>
                    <x-ui.button type="submit">Add Student</x-ui.button>
                </x-ui.card-footer>
            </x-ui.card>
        </div>
    </form>
</div>
@endsection
