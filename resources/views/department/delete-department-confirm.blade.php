<x-layout-app page-title="Editar departamentos">
    <div class="w-25 p-4">

        <h3>Editar department</h3>
        <hr>
        <p>Voce tem certeza que ira realizar?</p>

<div class="text-center">
    <h3 class="my-3">{{ $departamento->name }}</h3>

    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('departments') }}" class="btn btn-secondary px-5">
            Voltar
        </a>

        <a href="{{ route('departments.deletarDepartamento', ['id' => $departamento->id]) }}"
           class="btn btn-danger px-5">
            Deletar
        </a>
    </div>
</div>
    </div>

            @if (session('success_change_data'))
            <div class="alert alert-success mt-3">
                {{ session('success_change_data') }}
            </div>
        @endif
</x-layout-app>
