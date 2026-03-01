<x-layout-app title="Colaborators">
    <div class="w-100 p-4 colaborators-page">

        <h3>Colaborators</h3>
        <hr>

        @php
            $totalColaborators = $colaborators->count();
            $unicoColaborator = $totalColaborators === 1;
        @endphp

        @if ($totalColaborators === 0)
            <div class="text-center my-5 empty-state">
                <p>No colaborators found.</p>
                <a href="{{ route('telaAdicionarRH') }}" class="btn btn-primary">Criar colaborator</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('telaAdicionarRH') }}" class="btn btn-primary">Criar colaborator</a>
            </div>

            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Colaborator</th>
                        <th>Email</th>
                        <th>Permissões</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($colaborators as $colaborator)
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>{{ ucfirst(str_replace(['[', ']', '"'], '', $colaborator->permissions)) }}</td>
                            <td class="text-end">
                                <a href="{{ route('telaEditarRH',['id'=> $colaborator->id]) }}" class="btn btn-sm btn-outline-dark">Editar</a>
                                <a href="{{ route('telaApagarRH', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <hr>
    </div>
</x-layout-app>
