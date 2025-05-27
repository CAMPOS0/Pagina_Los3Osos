@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl p-6 bg-white rounded-lg shadow-lg border border-gray-200">
    <h1 class="text-3xl font-bold text-orange-600 mb-6 flex items-center">
        <img src="/imagenes/logo.png" class="h-10 w-10 mr-3 rounded-full border-2 border-orange-500" alt="Logo">
        Servicios
    </h1>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    {{-- FORMULARIO DE CREAR / EDITAR --}}
    <div class="card mb-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
        <div class="card-header bg-orange-600 text-white font-semibold rounded-t-lg px-4 py-2">
            {{ isset($servicioEdit) ? 'Editar Servicio' : 'Crear Servicio' }}
        </div>
        <div class="card-body p-4">
            <form action="{{ isset($servicioEdit) ? route('servicios.update', $servicioEdit) : route('servicios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($servicioEdit))
                    @method('PUT')
                @endif
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $servicioEdit->nombre ?? '' }}" required>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $servicioEdit->precio ?? '' }}" required>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Descripción</label>
                    <input type="text" name="descripcion" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $servicioEdit->descripcion ?? '' }}" required>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Imagen (opcional)</label>
                    <input type="file" name="imagen" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500">
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded transition">{{ isset($servicioEdit) ? 'Actualizar' : 'Crear' }}</button>
                    @if(isset($servicioEdit))
                        <a href="{{ route('servicios.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded transition">Cancelar</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    {{-- LISTADO --}}
    <div class="card-body p-4 mt-6">
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Descripción</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicios as $servicio)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $servicio->id }}</td>
                        <td class="px-4 py-2">{{ $servicio->nombre }}</td>
                        <td class="px-4 py-2">{{ $servicio->descripcion }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-sm bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded transition">Editar</a>
                            <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display:inline;">
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
</div>
@endsection
