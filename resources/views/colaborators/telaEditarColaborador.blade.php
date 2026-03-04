<x-layout-app page-title="Editar colaborador">

    <div class="container py-4">

        <h3 class="mb-3">Editar Colaborador</h3>
        <hr>

        <form action="{{route('updateColaborator')}}" method="POST">
            @csrf

            <input type="hidden" name="user_id" value="{{ $colaborador->id }}">

            <div class="row g-4">

                <!-- Card Dados Financeiros -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <h5 class="card-title mb-3">Informações Financeiras</h5>

                            <div class="mb-3">
                                <label for="salary" class="form-label">Salário</label>
                                <input type="number" class="form-control" id="salary" name="salary" step="0.01"
                                    placeholder="0.00" value="{{ old('salary', $colaborador->detail->salary) }}">
                                @error('salary')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Card Dados Contratuais -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <h5 class="card-title mb-3">Informações Contratuais</h5>

                            <div class="mb-3">
                                <label for="admission_date" class="form-label">Data de Admissão</label>
                                <input type="date" class="form-control" id="admission_date" name="admission_date"
                                    value="{{ old('admission_date', $userDetail->admission_date) }}">
                                @error('admission_date')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex">
                        <div class="flex-grow-1 pe-3">
                            <label for="select_department">Departamento</label>
                            <select name="select_department" class="form-select">
                                @foreach ($departamento as $department)
                                    <option value="{{ $department->id }}" {{ $department->id == $colaborador->department_id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>


                            @error('select_department')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <a href="{{route('departments.newDepartment')}}" class="btn btn-outline-primary mt-4">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Botões -->
            <div class="mt-4">
                <a href="{{ route('rh.management.home') }}" class="btn btn-outline-danger me-2">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    Salvar Alterações
                </button>
            </div>

        </form>

    </div>

</x-layout-app>
