@extends('errors_layout')


@section('content')
    <div class="container">
        <div class="row">

            <div class="col-12 text-center">
                <div class="d-flex justify-content-center mt-4">
                    <img src="../assets/images/book_404.png" alt="">
                </div>
                <div class="text-center mt-4">
                    <h2 class="display-4">ERROR 404, PÁGINA NÃO ENCONTRADA!!</h2>
                    <h4>A página que você solicitou não existe.</h4>
                    <h5>Por favor, clique <a href="/home">aqui</a> para retornar para página inicial</h5>
                    
                </div>
            </div>

        </div>
    </div>
@endsection
