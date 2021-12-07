@extends('layout')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="col-12">


                    <div class="mb-3">
                        <h2>Buscar livro</h2>
                    </div>

                    {{-- Mensagens de erro/sucesso --}}
                    @include('auxiliars.alert')

                    {{-- Formulario para adicionar livros --}}
                    <form action="/book/create" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="book_title" class="form-control" placeholder="Titulo do livro"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="book_publisher" class="form-control" placeholder="Editora do livro"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="book_published_date" class="form-control"
                                placeholder="Data de publicação" required>
                        </div>

                        <div class="form-group">
                            <input type="text" name="book_ratting" class="form-control"
                                placeholder="Avaliação do livro 5.0, 4.3..." required>
                        </div>


                        <div class="form-group">
                            <input type="text" name="book_pages_count" class="form-control"
                                placeholder="Número de páginas" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="book_isbn" class="form-control" placeholder="Isbn do livro" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="book_image_link" class="form-control"
                                placeholder="Link da capa do livro" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="book_authors" class="form-control"
                                placeholder="Autores do livro, exemplo: autor 1, autor 2, autor 3" required>
                        </div>
                        <div class="form-group">
                            <label for="book_description">Descrição do livro</label>
                            <textarea class="form-control" name="book_description" rows="3" required></textarea>
                        </div>

                        <button class="btn btn-info mb-2" name="send">Enviar</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
