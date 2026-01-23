<!-- Navigation -->
<nav>
    @if (Auth::check())
        <strong>Has hecho login como {{Auth::user()->name}}</strong><br>
    @endif
    <a href="{{ route('home') }}">Inicio</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('cuenta_list') }}">Cuentas</a>
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('cliente_list') }}">Clientes</a>
    &nbsp;&nbsp;&nbsp;

    @if (Auth::check())
        <!-- Usuario autenticado -->
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit">
                Logout
            </button>
        </form>
    @else
        <!-- Usuario no autenticado -->
        <a href="{{ route('login') }}">Login</a>
        &nbsp;&nbsp;&nbsp;
        <a href="{{ route('register') }}">Registrarse</a>
        &nbsp;&nbsp;&nbsp;
    @endif
</nav>
