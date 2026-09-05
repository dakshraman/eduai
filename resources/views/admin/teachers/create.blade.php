@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')
<div class="space-y-6 animate-fade-in-up">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Add Teacher</h1>
            <p class="text-muted-foreground">Add a new teacher to the system</p>
        </div>
        <x-ui.button variant="outline" href="{{ route('teachers.index') }}">Cancel</x-ui.button>
    </div>

    <form method="POST" action="{{ route('teachers.store') }}">
        @csrf
        <x-ui.card>
            <x-ui.card-header>
                <x-ui.card-title>Teacher Details</x-ui.card-title>
            </x-ui.card-header>
            <x-ui.card-content class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Full Name *</label>
                        <x-ui.input name="name" value="{{ old('name') }}" placeholder="Enter full name" />
                        @error('name') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Email *</label>
                        <x-ui.input type="email" name="email" value="{{ old('email') }}" placeholder="teacher@email.com" />
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
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Employee ID *</label>
                        <x-ui.input name="employee_id" value="{{ old('employee_id') }}" placeholder="Employee ID" />
                        @error('employee_id') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Designation</label>
                        <x-ui.input name="designation" value="{{ old('designation') }}" placeholder="e.g. Senior Teacher" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Department</label>
                        <x-ui.input name="department" value="{{ old('department') }}" placeholder="Department" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Salary</label>
                        <x-ui.input name="salary" value="{{ old('salary') }}" placeholder="Salary amount" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Qualification</label>
                        <x-ui.input name="qualification" value="{{ old('qualification') }}" placeholder="e.g. M.Sc, B.Ed" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Experience (years)</label>
                        <x-ui.input name="experience" value="{{ old('experience') }}" placeholder="Years of experience" />
                    </div>
                </div>
            </x-ui.card-content>
            <x-ui.card-footer class="flex justify-end gap-2">
                <x-ui.button variant="outline" href="{{ route('teachers.index') }}">Cancel</x-ui.button>
                <x-ui.button type="submit">Add Teacher</x-ui.button>
            </x-ui.card-footer>
        </x-ui.card>
    </form>
</div>
@endsection
