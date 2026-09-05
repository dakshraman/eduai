@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="space-y-6 animate-fade-in-up">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Teachers</h1>
            <p class="text-muted-foreground">Manage your teachers</p>
        </div>
        <x-ui.button href="{{ route('teachers.create') }}">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Add Teacher
        </x-ui.button>
    </div>

    <x-ui.card>
        <x-ui.card-content class="p-4">
            <form method="GET" class="flex items-end gap-4">
                <div class="flex-1">
                    <x-ui.input name="search" placeholder="Search teachers..." value="{{ request('search') }}" />
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
                        <x-ui.table-head>Employee ID</x-ui.table-head>
                        <x-ui.table-head>Designation</x-ui.table-head>
                        <x-ui.table-head>Phone</x-ui.table-head>
                        <x-ui.table-head>Status</x-ui.table-head>
                        <x-ui.table-head class="text-right">Actions</x-ui.table-head>
                    </x-ui.table-row>
                </x-ui.table-header>
                <x-ui.table-body>
                    @forelse($teachers as $teacher)
                        <x-ui.table-row>
                            <x-ui.table-cell class="font-medium">{{ $teacher->name }}</x-ui.table-cell>
                            <x-ui.table-cell>{{ $teacher->employee_id }}</x-ui.table-cell>
                            <x-ui.table-cell>{{ $teacher->designation ?? '-' }}</x-ui.table-cell>
                            <x-ui.table-cell>{{ $teacher->phone ?? '-' }}</x-ui.table-cell>
                            <x-ui.table-cell>
                                <x-ui.badge variant="{{ $teacher->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($teacher->status ?? 'active') }}
                                </x-ui.badge>
                            </x-ui.table-cell>
                            <x-ui.table-cell class="text-right">
                                <x-ui.button variant="ghost" size="sm" href="{{ route('teachers.edit', $teacher->id) }}">Edit</x-ui.button>
                                <form method="POST" action="{{ route('teachers.destroy', $teacher->id) }}" class="inline" onsubmit="return confirm('Delete this teacher?')">
                                    @csrf @method('DELETE')
                                    <x-ui.button type="submit" variant="ghost" size="sm" class="text-destructive">Delete</x-ui.button>
                                </form>
                            </x-ui.table-cell>
                        </x-ui.table-row>
                    @empty
                        <x-ui.table-row>
                            <x-ui.table-cell colspan="6" class="text-center py-8 text-muted-foreground">No teachers found.</x-ui.table-cell>
                        </x-ui.table-row>
                    @endforelse
                </x-ui.table-body>
            </x-ui.table>
        </x-ui.card-content>
        @if(method_exists($teachers ?? collect(), 'links'))
            <x-ui.card-footer class="px-6 py-4">
                {{ $teachers->links('components.ui.pagination', ['paginator' => $teachers]) }}
            </x-ui.card-footer>
        @endif
    </x-ui.card>
</div>
@endsection
