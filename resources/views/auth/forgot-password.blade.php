<x-layout-app page-tittle="Home">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-5">

                <!-- logo -->
                <div class="text-center mb-5">
                    <img src=" {{asset('assets/images/logo.png')}}" alt="Logo" width="200px">
                </div>

                <!-- forgot password -->
                <div class="card p-5">

                    <p>Para recuperar a sua senha, por favor indique o seu email. Irá receber um email com um link para
                        recuperar a senha.</p>

                    @if (!session(('status')))
                        <form action="#" method="post">
                            @CSRF
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{route('login')}}">Já sei a minha senha?</a>
                                <button type="submit" class="btn btn-primary px-4">Enviar email</button>
                            </div>

                        </form>
                    @else
                        <div class="text-center mb-5">
                            <p>Verifique caixa de email.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary px-4">Voltar ao login</a>
                        </div>

                    @endif

                </div>

            </div>
        </div>
    </div>

</x-layout-app>
