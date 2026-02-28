<x-layout-app page-title="Editar departamentos">
    <div class="">
        <h3>Editar departamento.</h3>
        <hr>
        <form action="{{ route('departments.updateDepartment') }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $departamento->id }}">


            <div class="mb-3">
                <label for="name" class="form-label">Nome do departamento</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $departamento->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    Modificar departamento.
                </button>
            </div>
        </form>
        <br>
        <div class="mb-3">
            <a href="{{ route('departments') }}">
                <button type="submit" class="btn btn-primary">Voltar</button>
            </a>
        </div>

    </div>
</x-layout-app>
