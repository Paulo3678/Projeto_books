<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title> LêBooks </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/favicon.png">

    <!-- Css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Css personalizado -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Icones -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    {{-- Jquery --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

</head>

<body>

    <nav>
        <div class="nav-wrapper black">
            <div class="container">
                <a href="/home" class="brand-logo">
                    <img src="../assets/images/_logo.png" alt="icon" id="icon-navbar">
                </a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="/home">Início</a></li>

                    <!-- Exibir se o usuário não estiver logado -->
                    @if (!session()->has('logado'))
                        @if (session('logado') !== true)
                            <li><a href="/login">Login</a></li>
                        @endif
                    @endif

                    <!-- Exibir se o usuário logado for um adm -->
                    @if (session()->has('admin'))
                        @if (session('admin') === true)
                            <li><a href="/book/create">Adicionar livro</a></li>
                        @endif
                    @endif
                    @if (session()->has('logado'))
                        @if (session('logado') === true)
                            <li><a href="/logout">Sair</a></li>
                        @endif
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    {{-- Application content --}}
    @yield('content')



    {{-- Rodapé --}}
    <footer class="page-footer black">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Sobre nós</h5>
                    <p class="grey-text text-lighten-4">
                        Nós da LêBooks queremos trazer aos leitores a oportunidade de saber mais sobre os livros de seu
                        interesse e
                        saber a opnião de outros leitores a respeito do mesmo, tudo isso de formas simples e prática.
                    </p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links de contato</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3"
                                href="mailto:d2019018540@unifei.edu.br">d2019018540@unifei.edu.br</a></li>
                        <li><a class="grey-text text-lighten-3"
                                href="mailto:luizebmartins@unifei.edu.br">luizebmartins@unifei.edu.br</a></li>
                        <li><a class="grey-text text-lighten-3"
                                href="mailto:luizebmartins@unifei.edu.br">luizebmartins@unifei.edu.br</a></li>
                        <li><a class="grey-text text-lighten-3"
                                href="mailto:d2019004231@unifei.edu.br">d2019004231@unifei.edu.br</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2021 LêBooks
                <a class="grey-text text-lighten-4 right" href="#!">Desenvolvido por Douglas, Luiz, Vítor e Yerro</a>
            </div>
        </div>
    </footer>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>

</html>
