<x-layout-app page-title="Editar RH">

    <div class="w-100 p-4">

        <h3>Editar Colaborador.</h3>

        <hr>
        <form action="{{ route('editarUserRH') }}" method="post">
            @csrf

            <div class="container-fluid">
                <div class="row gap-3">

                    <input type="hidden" name="id" value="{{ $colaborador->id }}">
                    {{-- usuário --}}
                    <div class="col border border-black p-4">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $colaborador->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $colaborador->email }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-grow-1 pe-3">
                                    <label for="select_department">Departamento</label>
<select name="select_department" class="form-select">
    @foreach ($departamento as $department)
        <option value="{{ $department->id }}"
            {{ $department->id == $colaborador->department_id ? 'selected' : '' }}>
            {{ $department->name }}
        </option>
    @endforeach
</select>


                                    @error('select_department')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <a href="{{route('departments.newDepartment')}}"
                                       class="btn btn-outline-primary mt-4">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <p class="mb-3">Perfil: <strong>Recursos Humanos</strong></p>

                    </div>

                    {{-- detalhes do usuário --}}
                    <div class="col border border-black p-4">

                        <div class="mb-3">
                            <label for="address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $userDetail->address }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">CEP</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $userDetail->zip_code }}">
                                    @error('zip_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ $userDetail->city }}">
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $userDetail->phone }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salário</label>
                                    <input type="number"
                                           class="form-control"
                                           id="salary"
                                           name="salary"
                                           step=".01"
                                           placeholder="0,00"
                                           value="{{ $userDetail->salary }}">
                                    @error('salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="admission_date" class="form-label">Data de Admissão</label>
                                    <input type="text"
                                           class="form-control"
                                           id="admission_date"
                                           name="admission_date"
                                           placeholder="YYYY-mm-dd"
                                           value="{{ $userDetail->admission_date }}">
                                    @error('admission_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="mt-3">
                    <a href="{{ route('rhUsers') }}" class="btn btn-outline-danger me-3">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>

            </div>

        </form>

    </div>

</x-layout-app>
