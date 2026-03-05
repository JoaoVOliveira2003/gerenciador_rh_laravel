
    <div class="border p-5 shadow-sm">
        <form action="{{ route('atualizarEndereco') }}" method="post">
            @csrf
            <h3>Change user Address</h3>
            @props(['colaborator'])
            <div class="mb-3">
                <label for="address" class="form-label">Name</label>
                <input type="text" name="address" id="address" class="form-control" value="{{old('name',$colaborator->detail->address)}}">
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="zip_code" class="form-label">zip_code</label>
                <input type="zip_code" name="zip_code" id="zip_code" class="form-control" value="{{old('name',$colaborator->detail->zip_code)}}">
                @error('zip_code')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">city</label>
                <input type="city" name="city" id="city" class="form-control" value="{{old('name',$colaborator->detail->city)}}">
                @error('city')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>



            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update endereço</button>
            </div>

        </form>

        @if (session('success_change_data_endereco'))
            <div class="alert alert-success mt-3">
                {{ session('success_change_data') }}
            </div>
        @endif
    </div>
