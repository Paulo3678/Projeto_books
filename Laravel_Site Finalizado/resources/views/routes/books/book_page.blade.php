@extends('layout')

@section('content')
    <!-- Box -->
    <div class="container">
        <div class="row">

            {{-- Mensagens de erro/sucesso --}}
            @include('auxiliars.alert')


            <!-- Sobre o livro -->
            <h3> Sobre o livro </h3>
            <hr>

            <div class="col s12 m4 l4 center">
                <img class="responsive-img" src="{{ $book['image_link'] }}">
            </div>

            <div class="col s12 m4 l4">
                <h5> <b> Título: </b> {{ $book['title'] }} </h5>
                <h5> <b> Autor: </b>
                    @foreach ($book['authors'] as $author)
                        {{ $author }}
                    @endforeach
                </h5>

                <h5> <b> Editora: </b> {{ $book['publisher'] }} </h5>
                <h5> <b> Data de publicação: </b> {{ $book['published_date'] }}</h5>
                <h5> <b> Páginas: </b> {{ $book['page_count'] }} </h5>
                <h5> <b> Avaliação: </b> {{ $book['rating'] }} </h5>
            </div>

            <div class="col s12 m4 l4">
                <h6> <b> Descrição: </b> {{ $book['description'] }} </h6>
            </div>

            <!-- Comentarios -->
            @if (session()->has('logado'))

                @if (session('logado') === true)

                    @if (session('admin') === true)

                        <div class="col s12">
                            <hr>
                            <form action="/book/delete/{{ $book['id'] }}" method="POST"
                                onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                <button href="" class="btn btn-danger btn-block">Excluir
                                    livro</button>
                            </form>
                        </div>
                    @endif

                    @if ($comments === 'Reviews not found')
                        <div class="col s12">
                            <h4><strong>Esse livro não contém nenhum comentário</strong></h4>
                        </div>
                    @else
                        {{-- Impressão dos comentários --}}
                        <div class="col s12">

                            <h3> Comentários </h3>
                            <hr>
                            @foreach ($comments as $comment)
                                <ul class="collection">
                                    <li class="collection-item">
                                        <h5>{{ $comment['user_name'] }}</h6>
                                            <p>
                                                <b> {{ $comment['title'] }} </b> <br>
                                                <b>Avaliação: </b>{{ $comment['rating'] }} <br>
                                                {{ $comment['content'] }}
                                            </p>
                                    </li>
                                </ul>
                            @endforeach
                            <br>
                        </div>

                    @endif

                    {{-- Formulário de adicionar Comentário --}}
                    <div class="col s12">
                        <form action="/comment/{{ $book['id'] }}" method="POST">
                            @csrf
                            <h5> Deixe seu comentário </h5>

                            <div class="input-field col l12 s12 white">
                                <input type="text" name="review_rating" class="validate"
                                    placeholder="Avaliação do livro" required autocomplete="off">
                            </div>

                            <div class="input-field col l12 s12 white">
                                <input id="icon_telephone" type="text" class="" name="review_comment"
                                    placeholder="Digite seu comentario" required autocomplete="off">
                            </div>
                            <br>
                            <button class="waves-effect black btn right"> Enviar <i
                                    class="material-icons right">arrow_forward</i></button>
                        </form>
                    </div>
                @endif

            @else
                <div class="col s12" style="margin-top: 10px">
                    <h4>Para vizualizar os comentários faça <a href="/login">login</a></h4>
                </div>
            @endif
        </div>

    </div>

@endsection
