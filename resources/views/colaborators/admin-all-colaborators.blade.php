<x-layout-app page-title="Colaborators">

    <div class="w-100 p-4">

        <h3>Todos colaborators</h3>

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
                        <th>Departamento</th>
                        <th>Data de admição</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($colaborators as $colaborator)
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>{{ ucfirst(str_replace(['[', ']', '"'], '', $colaborator->permissions)) }}</td>
                            <td>{{ $colaborator->department->name }}</td>
                            <td>
                                @empty($colaborator->email_verified_at)
                                <span class="badge bg-success">Sim</span>

                                @else
                                    <span class="badge bg-danger">Não</span>
                                @endempty
                            </td>
                            <td class="text-end">

                                @if(!empty($colaborator->deleted_at))
                                    <a href="{{ route('RestoreColaborador', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-danger">Restaurar</a>
                                @else
                                <a href="{{ route('verDetalhesUsuario', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-primary">Detalhes.</a>
                                <a href="{{ route('telaDeletarUsuarioSoft', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif


</x-layout-app>
