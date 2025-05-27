@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Encabezado -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-orange-600 flex items-center justify-center">
                <img src="/imagenes/logo.png" class="h-10 w-10 mr-3 rounded-full border-2 border-orange-500" alt="Logo Los 3 Osos">
                Editar Orden #{{ $orden->id }}
            </h1>
        </div>

        <!-- Formulario -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <form action="{{ route('empleado.orden.update', $orden) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Detalles de la Orden -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Platillo</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $orden->menu->nombre }}</p>
                </div>

                <!-- Cantidad -->
                <div class="mb-6">
                    <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-2">
                        Cantidad
                    </label>
                    <input type="number" 
                           name="cantidad" 
                           id="cantidad" 
                           value="{{ $orden->cantidad }}"
                           min="1"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                </div>

                <!-- Estado -->
                <div class="mb-6">
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                        Estado de la Orden
                    </label>
                    <select name="estado" 
                            id="estado" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        <option value="pendiente" {{ $orden->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en_proceso" {{ $orden->estado === 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="completada" {{ $orden->estado === 'completada' ? 'selected' : '' }}>Completada</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('empleado.orden.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
