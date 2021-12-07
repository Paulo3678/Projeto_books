@extends('layout')

@section('content')
    <!-- Box -->
    <div class="container mtop-box">
        <div class="row">

            <div class="col s12 m6 l6 offset-m3 offset-l3">

                {{-- Mensagens de erro/sucesso --}}
                @include('auxiliars.alert')

                <div>
                    <h4> <b> Cadastro </b> </h4>
                    <hr>
                    {{-- Formulário de cadastro --}}
                    <form action="/register" method="post">
                        @csrf

                        <div class="input-field col l12 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_telephone" type="text" class="validate" name="user_name" required>
                            <label for="icon_telephone">Nome</label>
                        </div>

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
                        <button class="btn right black" type="submit">Enviar</button>
                        <br> <br>

                    </form>

                </div>

            </div>

        </div>
    </div>

@endsection
