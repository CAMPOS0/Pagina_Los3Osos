@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl p-6 bg-white rounded-lg shadow-lg border border-gray-200">
    <h1 class="text-3xl font-bold text-orange-600 mb-6 flex items-center">
        <img src="/imagenes/logo.png" class="h-10 w-10 mr-3 rounded-full border-2 border-orange-500" alt="Logo">
        Usuarios
    </h1>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    {{-- FORMULARIO DE CREAR / EDITAR --}}
    <div class="card mb-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
        <div class="card-header bg-orange-600 text-white font-semibold rounded-t-lg px-4 py-2">
            {{ isset($usuarioEdit) ? 'Editar Usuario' : 'Crear Usuario' }}
        </div>
        <div class="card-body p-4">
            <form action="{{ isset($usuarioEdit) ? route('usuarios.update', $usuarioEdit) : route('usuarios.store') }}" method="POST">
                @csrf
                @if(isset($usuarioEdit))
                    @method('PUT')
                @endif
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Nombre</label>
                    <input type="text" name="name" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $usuarioEdit->name ?? '' }}" required>
                </div>
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" value="{{ $usuarioEdit->email ?? '' }}" required>
                </div>
                @if(!isset($usuarioEdit))
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Contraseña</label>
                    <input type="password" name="password" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" required>
                </div>
                @endif
                <div class="form-group mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Rol</label>
                    <select name="role" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" required>
                        <option value="admin" {{ (isset($usuarioEdit) && $usuarioEdit->role == 'admin') ? 'selected' : '' }}>Admin</option>
                        <option value="cliente" {{ (isset($usuarioEdit) && $usuarioEdit->role == 'cliente') ? 'selected' : '' }}>Cliente</option>
                        <option value="empleado" {{ (isset($usuarioEdit) && $usuarioEdit->role == 'empleado') ? 'selected' : '' }}>Empleado</option>
                    </select>
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded transition">{{ isset($usuarioEdit) ? 'Actualizar' : 'Crear' }}</button>
                    @if(isset($usuarioEdit))
                        <a href="{{ route('usuarios.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded transition">Cancelar</a>
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
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Rol</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr class="border-t border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $usuario->id }}</td>
                        <td class="px-4 py-2">{{ $usuario->name }}</td>
                        <td class="px-4 py-2">{{ $usuario->email }}</td>
                        <td class="px-4 py-2">{{ $usuario->rol ?? '' }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('usuarios.index', ['edit' => $usuario->id]) }}" class="btn btn-sm bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded transition">Editar</a>
                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" style="display:inline;">
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
