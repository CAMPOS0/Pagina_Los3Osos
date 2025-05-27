@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Encabezado -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-orange-600 flex items-center justify-center">
                <img src="/imagenes/logo.png" class="h-10 w-10 mr-3 rounded-full border-2 border-orange-500" alt="Logo Los 3 Osos">
                Órdenes Activas
            </h1>
            <p class="text-lg text-gray-600">Gestiona las órdenes actuales</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 rounded-lg text-green-700 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de Órdenes -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Platillo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($ordenes as $orden)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $orden->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $orden->menu->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $orden->cantidad }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-orange-600 font-semibold">${{ number_format($orden->total, 2) }}</span>
                        </td>                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $orden->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $orden->estado === 'en_proceso' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $orden->estado === 'completada' ? 'bg-green-100 text-green-800' : '' }}">
                                {{ ucfirst($orden->estado) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $orden->notes }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('empleado.orden.edit', $orden) }}" 
                               class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded transition">
                                Editar
                            </a>
                            <form action="{{ route('empleado.orden.destroy', $orden) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition"
                                        onclick="return confirm('¿Estás seguro de eliminar esta orden?')">
                                    Eliminar
                                </button>
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
