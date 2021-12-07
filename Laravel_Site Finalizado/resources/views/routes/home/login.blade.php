@extends('layout')


@section('content')
    <div class="container mtop-box">
        <div class="row">

            {{-- Mensagens de erro/sucesso --}}
            @include('auxiliars.alert')

            <div class="col s12 m6 l6 offset-m3 offset-l3">

                <div>
                    <h4> <b> Login </b> </h4>
                    <hr>


                    {{-- Formulário de login --}}
                    <form action="/login" method="post">
                        @csrf

                        <div class="input-field col l12 s12">
                            <i class="material-icons prefix">email</i>
                            <input id="icon_telephone" type="email" class="validate" name="user_email" required>
                            <label for="icon_telephone">Email</label>
                        </div>

                        <div class="input-field col l12 s12">
                            <i class="material-icons prefix">https</i>
                            <input id="icon_telephone" type="password" class="validate" name="user_password" required>
                            <label for="icon_telephone">Senha</label>
                        </div>
                        &nbsp; &nbsp;

                        <button type="submit" class="btn right black">Entrar</button>
                        <br> <br>
                        <h6 align="center">
                            Ainda não é cadastrado? <a href="/register"> Clique aqui. </a>
                        </h6>
                    </form>


                </div>

            </div>

        </div>
    </div>

@endsection
<!-- Box -->
