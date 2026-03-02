<x-layout-app page-title="Delete colaborator">

    <div class="w-25 p-4">

        <h3>Delete colaborator</h3>

        <hr>

        <p>Are you sure you want to delete this colaborator?</p>

        <div class="text-center">
            <h3 class="my-5">{{$colaborator->name}}</h3>
            <p>{{$colaborator->email}}</p>
            <a href="{{route('verTodosUsuarios')}}" class="btn btn-secondary btn-sm">No</a>
            <a href="{{ route('DeletarUsuarioSoftConfirm', ['id' => $colaborator->id]) }}" class="btn btn-sm btn-outline-danger">Delete</a>
        </div>

    </div>

</x-layout-app>
