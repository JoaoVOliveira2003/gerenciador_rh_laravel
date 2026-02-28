
<div class="d-flex flex-column sidebar pt-4">
    <a href="{{route('home')}}"><i class="fas fa-home me-3"></i>Home</a>
    @can('admin')
        <a href="#"><i class="fas fa-users me-3"></i>Colaboradores</a>
        <a href="{{ route('rhUsers') }}"><i class="fas fa-user-gear me-3"></i>Colaboradores RH</a>
        <a href="{{route('departments')}}"><i class="fas fa-industry me-3"></i>Departamentos</a>
    @endcan
    <hr>
    <a href="{{ route('user.profile') }}"><i class="fas fa-cog me-3"></i>User profile</a>
    <hr>
    <div class="text-center mt-3">
        <form action="submit" class="btn btn-sm btn-outline-dark">
            <i class="fas fa-sign-out-alt me-3"></i> logout
        </form>
    </div>
</div>

<style>
    /* Sidebar inteira */
.sidebar {
    color: #000;
}

/* Links */
.sidebar a {
    color: #000;
    text-decoration: none;
}

.sidebar a:hover {
    color: #000;
    text-decoration: none;
}

/* Ícones (Font Awesome) */
.sidebar i {
    color: #000;
}

/* Linhas */
.sidebar hr {
    border-color: #000;
}

/* Botão de logout */
.sidebar .btn {
    color: #000;
    border-color: #000;
}

.sidebar .btn:hover {
    background-color: #000;
    color: #fff;
}
</style>
