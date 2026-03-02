<x-layout-guest pageTitle="Bem vindo">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">

                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png')}}" alt="Logo" width="200px">
                </div>

                <div class="card p-5 text-center">
                    <p>Olá, <strong>{{ $user->name }}</strong>!</p>
                    <p>Sua confirmação foi feita corretamente.</p>
                    <p>Vc pode entrar em <a href="{{ route('login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</x-layout-guest>
