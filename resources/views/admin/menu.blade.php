@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl p-6 bg-white rounded-lg shadow-lg border border-gray-200">
    <h1 class="text-3xl font-bold text-orange-600 mb-6 flex items-center">
        <img src="/imagenes/logo.png" class="h-10 w-10 mr-3 rounded-full border-2 border-orange-500" alt="Logo">
        Menús
    </h1>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    {{-- FORMULARIO DE CREAR / EDITAR --}}
    <div class="card mb-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
        <div class="card-header bg-orange-600 text-white font-semibold rounded-t-lg px-4 py-2">
            {{ isset($menuEdit) ? 'Editar Menú' : 'Crear Menú' }}
        </div>
        <div class="card-body p-4">
            <form action="{{ isset($menuEdit) ? route('menus.update', $menuEdit) : route('menus.store') }}" method="POST">
                @csrf
                @if(isset($menuEdit))
                    @method('PUT')
                @endif
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $menuEdit->nombre ?? '' }}" required>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $menuEdit->precio ?? '' }}" required>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Descripción</label>
                    <input type="text" name="descripcion" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $menuEdit->descripcion ?? '' }}" required>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Imagen (URL)</label>
                    <input type="text" name="imagen" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $menuEdit->imagen ?? '' }}">
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded transition">{{ isset($menuEdit) ? 'Actualizar' : 'Crear' }}</button>
                    @if(isset($menuEdit))
                        <a href="{{ route('menus.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded transition">Cancelar</a>
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
                    @foreach ($menus as $menu)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $menu->id }}</td>
                        <td class="px-4 py-2">{{ $menu->nombre }}</td>
                        <td class="px-4 py-2">{{ $menu->descripcion }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('menus.index', ['edit' => $menu->id]) }}" class="btn btn-sm bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded transition">Editar</a>
                            <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline;">
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
