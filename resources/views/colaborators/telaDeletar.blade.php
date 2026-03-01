<x-layout-app page-title="Deseja deletar colaborador ?">
    <div class="w-25 p-4">

        <p>Deseja apagar usuario ?</p>

        <div class="text-center">
            <h3 class="my-3">{{ $colaborador->name }}</h3>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('rhUsers') }}" class="btn btn-secondary px-5">Voltar</a>
                <a href="{{route('deletarPessoaRH',['id'=>$colaborador->id])}}"class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
            </div>
        </div>
    </div>

    @if (session('success_change_data'))
        <div class="alert alert-success mt-3">
            {{ session('success_change_data') }}
        </div>
    @endif
</x-layout-app>
