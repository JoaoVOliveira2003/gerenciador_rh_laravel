<x-layout-app title="Departments">
    <div class="w-100 p-4">

        <h3>Departments</h3>
        <hr>

        @php
            $totalDepartamentos = $departamentos->count();
            $unicoDepartamento = $totalDepartamentos === 1;
        @endphp

        @if ($totalDepartamentos === 0)
            <div class="text-center my-5">
                <p>No departments found.</p>
                <a href="{{ route('departments.newDepartment') }}" class="btn btn-primary">
                    Criar departamento
                </a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('departments.newDepartment') }}" class="btn btn-primary">
                    Criar departamento
                </a>
            </div>

            <table class="table w-50" id="table">
                <thead class="table-dark">
                    <tr>
                        <th>Departamento</th>
                        <th class="text-end"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($departamentos as $departamento)
                        <tr>
                            <td>{{ $departamento->name }}</td>

                            <td class="text-end">
                                @if ($unicoDepartamento)
                                    <i class="fa-solid fa-lock"></i>
                                @else
                                    <a href="{{route('departments.editDepartment',['id'=>$departamento->id])}}"
                                       class="btn btn-sm btn-outline-dark">
                                        <i class="fa-regular fa-pen-to-square me-2"></i>
                                        Edit
                                    </a>

                                    <a href="{{route('departments.telaDeletarDepartmento',['id'=>$departamento->id])}}"
                                       class="btn btn-sm btn-outline-dark">
                                        <i class="fa-regular fa-trash-can me-2"></i>
                                        Delete
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <hr>
    </div>
</x-layout-app>
