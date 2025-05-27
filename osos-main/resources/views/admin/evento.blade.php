@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl p-6 bg-white rounded-lg shadow-lg border border-gray-200">
    <h1 class="text-3xl font-bold text-orange-600 mb-6 flex items-center"><img src="/imagenes/logo.png" class="h-10 w-10 mr-3 rounded-full border-2 border-orange-500" alt="Logo">Eventos</h1>
    {{-- FORMULARIO DE CREAR / EDITAR --}}
    <div class="card mb-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
        <div class="card-header bg-orange-600 text-white font-semibold rounded-t-lg px-4 py-2">
            {{ isset($eventoEdit) ? 'Editar Evento' : 'Crear Evento' }}
        </div>
        <div class="card-body p-4">
            <form action="{{ isset($eventoEdit) ? route('eventos.update', $eventoEdit) : route('eventos.store') }}" method="POST">
                @csrf
                @if(isset($eventoEdit))
                    @method('PUT')
                @endif
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Servicio</label>
                    <select name="servicio_id" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" required>
                        @foreach ($servicios as $servicio)
                            <option value="{{ $servicio->id }}" {{ (isset($eventoEdit) && $eventoEdit->servicio_id == $servicio->id) ? 'selected' : '' }}>{{ $servicio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Precio Final</label>
                    <input type="number" step="0.01" name="precio_final" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $eventoEdit->precio_final ?? '' }}" required>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Ubicación</label>
                    <input type="text" name="ubicacion" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $eventoEdit->ubicacion ?? '' }}" required>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Fecha</label>
                    <input type="datetime-local" name="fecha" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ isset($eventoEdit) ? $eventoEdit->fecha->format('Y-m-d\TH:i') : '' }}" required>
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded transition">{{ isset($eventoEdit) ? 'Actualizar' : 'Crear' }}</button>
                    @if(isset($eventoEdit))
                        <a href="{{ route('eventos.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded transition">Cancelar</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    {{-- LISTADO --}}
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Servicio</th>
                    <th class="px-4 py-2">Precio Final</th>
                    <th class="px-4 py-2">Ubicación</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventos as $evento)
                <tr class="border-t border-gray-200 hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $evento->id }}</td>
                    <td class="px-4 py-2">{{ $evento->servicio->nombre }}</td>
                    <td class="px-4 py-2">${{ number_format($evento->precio_final, 2) }}</td>
                    <td class="px-4 py-2">{{ $evento->ubicacion }}</td>
                    <td class="px-4 py-2">{{ $evento->fecha->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('eventos.index', ['edit' => $evento->id]) }}" class="btn btn-sm bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded transition">Editar</a>
                        <form action="{{ route('eventos.destroy', $evento) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
