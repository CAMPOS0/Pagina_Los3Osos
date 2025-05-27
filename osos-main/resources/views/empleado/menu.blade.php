@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Encabezado -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-orange-600 flex items-center justify-center">
                <img src="/imagenes/logo.png" class="h-10 w-10 mr-3 rounded-full border-2 border-orange-500" alt="Logo Los 3 Osos">
                Menú Disponible
            </h1>
            <p class="text-lg text-gray-600">Descubre y selecciona tus platillos favoritos</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 rounded-lg text-green-700 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Grid de Menús -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($menus as $menu)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                    <!-- Imagen del platillo -->
                    @if($menu->imagen)
                        <img src="{{ $menu->imagen }}" class="w-full h-48 object-cover" alt="{{ $menu->nombre }}">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=Sin+Imagen" class="w-full h-48 object-cover" alt="Sin imagen">
                    @endif

                    <!-- Contenido del menú -->
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $menu->nombre }}</h2>
                        <p class="text-gray-600 mb-4">{{ $menu->descripcion }}</p>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-orange-600">${{ $menu->precio }}</span>
                        </div>
                        <!-- Formulario para crear orden -->
                        <form action="{{ route('empleado.menu.crear-orden') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <div class="flex items-center space-x-2">
                                <label for="cantidad_{{ $menu->id }}" class="text-gray-700">Cantidad:</label>
                                <input type="number" 
                                       name="cantidad" 
                                       id="cantidad_{{ $menu->id }}" 
                                       value="1" 
                                       min="1" 
                                       class="w-20 rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                            </div>
                            <button type="submit"
                                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Agregar a orden
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
