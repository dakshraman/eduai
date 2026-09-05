@extends('layouts.app')

@section('title', 'Transport')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-3">
        <h1 class="text-2xl font-bold text-gray-900">Transport Management</h1>
    </div>

    {{-- Routes Section --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3">Routes</h2>

        <form method="POST" action="{{ route('transport.storeRoute') }}" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="name" placeholder="Route name" required
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
            <input type="number" name="fare" placeholder="Fare" step="0.01" min="0" required
                   class="w-32 px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">Add Route</button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Name</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Fare</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Vehicles</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($routes as $route)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $route->name }}</td>
                            <td class="px-5 py-3 text-gray-600">${{ number_format($route->fare, 2) }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $route->vehicles_count }}</td>
                            <td class="px-5 py-3 text-right">
                                <form method="POST" action="{{ route('transport.destroyRoute', $route) }}" onsubmit="return confirm('Delete this route?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Delete">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-8 text-center text-gray-400">No routes found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Vehicles Section --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3">Vehicles</h2>

        <form method="POST" action="{{ route('transport.storeVehicle') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Plate Number *</label>
                    <input type="text" name="plate_number" value="{{ old('plate_number') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                    @error('plate_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle Type *</label>
                    <select name="vehicle_type" required class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        <option value="">Select</option>
                        <option value="bus" {{ old('vehicle_type') === 'bus' ? 'selected' : '' }}>Bus</option>
                        <option value="van" {{ old('vehicle_type') === 'van' ? 'selected' : '' }}>Van</option>
                        <option value="car" {{ old('vehicle_type') === 'car' ? 'selected' : '' }}>Car</option>
                    </select>
                    @error('vehicle_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Capacity *</label>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" min="1" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                    @error('capacity') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Route</label>
                    <select name="transport_route_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        <option value="">None</option>
                        @foreach($routes as $route)
                            <option value="{{ $route->id }}" {{ old('transport_route_id') == $route->id ? 'selected' : '' }}>{{ $route->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver Name</label>
                    <input type="text" name="driver_name" value="{{ old('driver_name') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver Phone</label>
                    <input type="text" name="driver_phone" value="{{ old('driver_phone') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                </div>
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">Add Vehicle</button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Plate</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Type</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Capacity</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Driver</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Route</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $vehicle->plate_number }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-700">{{ ucfirst($vehicle->vehicle_type) }}</span>
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $vehicle->capacity }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $vehicle->driver_name ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $vehicle->route->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-right">
                                <form method="POST" action="{{ route('transport.destroyVehicle', $vehicle) }}" onsubmit="return confirm('Delete this vehicle?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Delete">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-gray-400">No vehicles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
