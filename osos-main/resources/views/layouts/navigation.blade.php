<nav class="w-full bg-black shadow-lg fixed top-0 left-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo y Nombre -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <img src="/imagenes/logo.png" alt="Logo Los 3 Osos" class="h-10 w-10 rounded-full border-2 border-orange-500 bg-white" />
                <span class="text-2xl font-bold text-orange-500 tracking-wide">Los 3 Osos</span>
            </a>
            <!-- Enlaces de navegación -->
            <div class="flex space-x-6">
                @if(Auth::user() && Auth::user()->role === 'admin')
                    <a href="{{ route('eventos.index') }}" class="text-gray-200 hover:text-orange-500 font-semibold transition">Eventos</a>
                    <a href="{{ route('servicios.index') }}" class="text-gray-200 hover:text-orange-500 font-semibold transition">Servicios</a>
                    <a href="{{ route('menus.index') }}" class="text-gray-200 hover:text-orange-500 font-semibold transition">Menús</a>
                    <a href="{{ route('usuarios.index') }}" class="text-gray-200 hover:text-orange-500 font-semibold transition">Usuarios</a>
                @elseif(Auth::user() && Auth::user()->role === 'empleado')
                    <a href="{{ route('empleado.menu') }}" class="text-gray-200 hover:text-orange-500 font-semibold transition">Menú</a>
                    <a href="{{ route('empleado.orden.index') }}" class="text-gray-200 hover:text-orange-500 font-semibold transition">Órdenes</a>
                @endif
            </div>
            <!-- Usuario y salir -->
            <div class="flex items-center space-x-4">
                <span class="text-gray-300 font-medium">{{ Auth::user()?->name ?? 'Invitado' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded transition">Salir</button>
                </form>
            </div>
        </div>
    </div>
</nav>
<div class="h-16"></div>
