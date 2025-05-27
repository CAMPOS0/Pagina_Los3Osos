@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[70vh] bg-transparent">
    <div class="w-full max-w-xl p-6 bg-white rounded-lg shadow-lg border border-gray-200">
        <h1 class="text-3xl font-bold text-orange-600 mb-6 flex items-center">
            <img src="/imagenes/logo.png" class="h-10 w-10 mr-3 rounded-full border-2 border-orange-500" alt="Logo">
            Cotizar Evento
        </h1>
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <!-- Formulario de cotización -->
        <form action="{{ route('cliente.cotizar') }}" method="POST" class="space-y-4" autocomplete="off">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">Servicio</label>
                <select name="servicio_id" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" required id="servicioSelect">
                    @foreach ($servicios as $servicio)
                        <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">
                            {{ $servicio->nombre }} - ${{ $servicio->precio }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Ubicación del evento</label>
                <input type="text" name="ubicacion" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" required placeholder="Dirección completa">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Fecha y Hora</label>
                <input type="datetime-local" name="fecha" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Cantidad de personas</label>
                <input type="number" name="personas" id="personasInput" class="form-control w-full border-gray-300 rounded focus:border-orange-500 focus:ring-orange-500" min="1" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Precio estimado</label>
                <input type="text" id="precioCalculado" class="form-control w-full border-gray-300 rounded bg-gray-100" readonly>
            </div>
            <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded transition">Guardar Cotización</button>
        </form>
    </div>
</div>
<script>
    // Obtener elementos del formulario
    const servicioSelect = document.getElementById('servicioSelect');
    const personasInput = document.getElementById('personasInput');
    const precioCalculado = document.getElementById('precioCalculado');

    // Función para calcular el precio
    function calcularPrecio() {
        const servicioPrecio = servicioSelect.options[servicioSelect.selectedIndex]?.getAttribute('data-precio');
        const personas = personasInput.value;
        if (servicioPrecio && personas) {
            // Calcular precio final
            precioCalculado.value = '$' + (servicioPrecio * personas);
        } else {
            // Si no hay valor, vaciar el campo de precio
            precioCalculado.value = '';
        }
    }

    // Agregar eventos para calcular el precio al seleccionar un servicio o poner la cantidad de personas
    servicioSelect.addEventListener('change', calcularPrecio);
    personasInput.addEventListener('input', calcularPrecio);
</script>
@endsection
