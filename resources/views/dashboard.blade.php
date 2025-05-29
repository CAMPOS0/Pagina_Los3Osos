<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8 flex flex-col items-center">
            <img src="/imagenes/logo.png" class="h-20 w-20 mb-4 rounded-full border-2 border-orange-500" alt="Logo Los 3 Osos">
            <h1 class="text-4xl font-bold text-orange-600 mb-4">Bienvenido a Los 3 Osos</h1>
            <p class="text-xl text-gray-700 dark:text-gray-200 max-w-2xl text-center bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                "En Los 3 Osos, cada platillo es un abrazo, cada mesa es un reencuentro y cada sabor une corazones. Nuestra cocina celebra la familia, la unión y el amor en cada bocado. ¡Ven y comparte momentos inolvidables con quienes más amas!"
            </p>
        </div>
    </div>
</div>
</x-app-layout>
