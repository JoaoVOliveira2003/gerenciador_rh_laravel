<x-layout-app title="Departaments">
    <div class="w-100 p-4">

        <h3>Departments</h3>

        <hr>

        @if ($departamentos->count() === 0)
            <div class="text-center my-5">
                <p>No departments found.</p>
                <a href="#" class="btn btn-primary">Criar departamento</a>
            </div>
        @else


        @endif

        <div class="mb-3">
            <a href="#" class="btn btn-primary">Criar departamento</a>
        </div>

        <table class="table w-50" id="table">
            <thead class="table-dark">
                <th>Departmento</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($departamentos as $departamento)
                <tr>
                    <td>{{ $departamento->name }}</td>
                    <td>
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="#" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-pen-to-square me-2"></i>Edit</a>
                            <a href="#" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-trash-can me-2"></i>Delete</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr>
    </div>
</x-layout-app>
