@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl animate-fade-in-up font-bold text-gray-900">Attendance</h1>

    {{-- Class & Date selector --}}
    <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-5">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <select name="class_id" required class="flex-1 px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi">
                <option value="">Select Class</option>
                @foreach($classes ?? [] as $class)
                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}" required
                   class="px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi">
            <button type="submit" class="px-6 py-2 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-medium btn-ripple rounded-xl transition">Load Students</button>
        </form>
    </div>

    {{-- Attendance form --}}
    @if(isset($students) && count($students) > 0)
        <form method="POST" action="{{ route('attendance.store') }}">
            @csrf
            <input type="hidden" name="class_id" value="{{ request('class_id') }}">
            <input type="hidden" name="date" value="{{ request('date', date('Y-m-d')) }}">

            <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-[#FFF6E3]/50 border-b border-[#BFECFF]/20">
                            <tr>
                                <th class="text-left px-5 py-3 font-semibold text-gray-600">Name</th>
                                <th class="text-center px-5 py-3 font-semibold text-gray-600">Present</th>
                                <th class="text-center px-5 py-3 font-semibold text-gray-600">Absent</th>
                                <th class="text-center px-5 py-3 font-semibold text-gray-600">Late</th>
                                <th class="text-center px-5 py-3 font-semibold text-gray-600">Half Day</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($students as $student)
                                <tr class="table-row-hover">
                                    <td class="px-5 py-3 font-medium text-gray-900">{{ $student->name }}</td>
                                    <td class="px-5 py-3 text-center">
                                        <input type="radio" name="attendance[{{ $student->id }}]" value="present"
                                               {{ ($existing[$student->id] ?? null) === 'present' ? 'checked' : '' }}
                                               class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                    </td>
                                    <td class="px-5 py-3 text-center">
                                        <input type="radio" name="attendance[{{ $student->id }}]" value="absent"
                                               {{ ($existing[$student->id] ?? null) === 'absent' ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 border-gray-300 focus:ring-red-500">
                                    </td>
                                    <td class="px-5 py-3 text-center">
                                        <input type="radio" name="attendance[{{ $student->id }}]" value="late"
                                               {{ ($existing[$student->id] ?? null) === 'late' ? 'checked' : '' }}
                                               class="w-4 h-4 text-amber-600 border-gray-300 focus:ring-amber-500">
                                    </td>
                                    <td class="px-5 py-3 text-center">
                                        <input type="radio" name="attendance[{{ $student->id }}]" value="half_day"
                                               {{ ($existing[$student->id] ?? null) === 'half_day' ? 'checked' : '' }}
                                               class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-4 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2.5 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-semibold btn-ripple rounded-xl transition">Save Attendance</button>
                </div>
            </div>
        </form>
    @elseif(request('class_id'))
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-12 text-center text-gray-400 text-sm">
            No students found for this class.
        </div>
    @endif
</div>
@endsection
