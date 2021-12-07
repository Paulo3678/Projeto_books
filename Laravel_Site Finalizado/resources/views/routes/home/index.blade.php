@extends('layout')

@section('content')
    <div class="col l12" id="poster">
        <div class="texts white-text">
            <h2> LêBooks </h2>
            <h4> Seu site de reviews de livros </h4>
        </div>
    </div>

    <!-- Busca -->
    <section id="search" class="section section-search black white-text center scrollspy">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h4> Busque seus livros favoritos </h4>


                    {{-- Mensagens de erro/sucesso --}}
                    @include('auxiliars.alert')

                    <form action="/search/book" method="post">
                        @csrf
                        <div class="input-field">
                            <input type="text" name="book_name" class="autocomplete white black-text center"
                                placeholder="Digite o nome do livro desejado" id="search-input" required>
                        </div>
                        {{-- Precisa verificar se o nome do livro foi passado antes de enviar, usar JavaScript --}}
                        <button class="btn btn-info mb-2">Enviar</button>
                    </form>

                </div>
            </div>
        </div>
    </section>

    {{-- Resultado da pesquisa --}}
    @if (session()->has('search_result'))
        <div class="container">
            <div class="row">
                @foreach (session('search_result') as $book)
                    <div class="col s12 m6 l4">

                        <div class="card horizontal">
                            <div class="card-image">
                                <img src="{{ $book['image_link'] }}">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <h6> <b> {{ $book['title'] }} </b> </h6>
                                    <p>
                                        Autor: @foreach ($book['authors'] as $author)
                                            {{ $author . ', ' }}
                                        @endforeach <br>
                                        Nota: {{ $book['rating'] }}
                                    </p>
                                </div>
                                <div class="card-action">
                                    <a href="/book/{{ $book['id'] }}">Ver mais</a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    @endif


    <div class="container">
        <!-- Icones -->
        <div class="row mtop-25">

            <div class="col s12 m6 l4 center">
                <img src="./assets/images/book_icon.svg" alt="book_icon" class="icons">
                <h4> Diversidade </h4>
                <h5> Possuimos informações de uma grande variedade de livros </h5>
            </div>

            <div class="col s12 m6 l4 center">
                <img src="./assets/images/list_icon.svg" alt="list_icon" class="icons">
                <h4> Seus preferidos </h4>
                <h5> Busque informações sobre seus livros favoritos </h5>
            </div>

            <div class="col s12 m6 l4 offset-m3 center">
                <img src="./assets/images/people_icon.svg" alt="people_icon" class="icons">
                <h4> Interaja </h4>
                <h5> Veja a opnião e comentarios de outros usuários </h5>
            </div>

        </div>
    </div>
    <hr>

@endsection
