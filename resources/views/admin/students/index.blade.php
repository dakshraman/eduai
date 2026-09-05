@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="space-y-6 animate-fade-in-up">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Students</h1>
            <p class="text-muted-foreground">Manage your students</p>
        </div>
        <x-ui.button href="{{ route('students.create') }}">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Add Student
        </x-ui.button>
    </div>

    <x-ui.card>
        <x-ui.card-content class="p-4">
            <form method="GET" class="flex items-end gap-4">
                <div class="flex-1">
                    <x-ui.input name="search" placeholder="Search students..." value="{{ request('search') }}" />
                </div>
                <div class="w-48">
                    <x-ui.select name="class_id" placeholder="All Classes" :options="$classes->pluck('name','id')->toArray()" :value="request('class_id')" />
                </div>
                <x-ui.button type="submit" variant="secondary">Search</x-ui.button>
            </form>
        </x-ui.card-content>
    </x-ui.card>

    <x-ui.card>
        <x-ui.card-content class="p-0">
            <x-ui.table>
                <x-ui.table-header>
                    <x-ui.table-row>
                        <x-ui.table-head>Name</x-ui.table-head>
                        <x-ui.table-head>Admission #</x-ui.table-head>
                        <x-ui.table-head>Class</x-ui.table-head>
                        <x-ui.table-head>Section</x-ui.table-head>
                        <x-ui.table-head>Status</x-ui.table-head>
                        <x-ui.table-head class="text-right">Actions</x-ui.table-head>
                    </x-ui.table-row>
                </x-ui.table-header>
                <x-ui.table-body>
                    @forelse($students as $student)
                        <x-ui.table-row>
                            <x-ui.table-cell class="font-medium">{{ $student->name }}</x-ui.table-cell>
                            <x-ui.table-cell>{{ $student->admission_number }}</x-ui.table-cell>
                            <x-ui.table-cell>{{ $student->class->name ?? '-' }}</x-ui.table-cell>
                            <x-ui.table-cell>{{ $student->section ?? '-' }}</x-ui.table-cell>
                            <x-ui.table-cell>
                                <x-ui.badge variant="{{ $student->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($student->status) }}
                                </x-ui.badge>
                            </x-ui.table-cell>
                            <x-ui.table-cell class="text-right">
                                <x-ui.button variant="ghost" size="sm" href="{{ route('students.show', $student->id) }}">View</x-ui.button>
                                <x-ui.button variant="ghost" size="sm" href="{{ route('students.edit', $student->id) }}">Edit</x-ui.button>
                                <form method="POST" action="{{ route('students.destroy', $student->id) }}" class="inline" onsubmit="return confirm('Delete this student?')">
                                    @csrf @method('DELETE')
                                    <x-ui.button type="submit" variant="ghost" size="sm" class="text-destructive">Delete</x-ui.button>
                                </form>
                            </x-ui.table-cell>
                        </x-ui.table-row>
                    @empty
                        <x-ui.table-row>
                            <x-ui.table-cell colspan="6" class="text-center py-8 text-muted-foreground">No students found.</x-ui.table-cell>
                        </x-ui.table-row>
                    @endforelse
                </x-ui.table-body>
            </x-ui.table>
        </x-ui.card-content>
        @if(method_exists($students ?? collect(), 'links'))
            <x-ui.card-footer class="px-6 py-4">
                {{ $students->links('components.ui.pagination', ['paginator' => $students]) }}
            </x-ui.card-footer>
        @endif
    </x-ui.card>
</div>
@endsection
