<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ApiRequests;
use App\Http\Services\Comments\CommentVerify;
use App\Http\Services\CommentServices;
use App\Http\Services\MessageGenerator;
use App\Http\Services\TokenFactory;

class Comments
{
    public function addComment(Request $request, int $book_id)
    {
        // Filtra  a avaliação
        if (str_contains($request->review_rating, ",")) {
            $request->review_rating = str_replace(",", ".", $request->review_rating);
        }

        // Busca o livro
        $book = json_decode(ApiRequests::getRequest("/books/{$book_id}"), true);
        $token = (new TokenFactory())->getToken($request);
        $ratting = $request->review_rating;

        // Verifica a avaliação do usuário
        $commentVerifier = new CommentVerify();
        $retorno = $commentVerifier->verificarComentarios($ratting, $request);
        if ($retorno !== "Tudo ok") {
            MessageGenerator::errorMessage($request, $retorno);
            return redirect()->back();
        }

        // Monta json do comentário
        $ratting = floatval($ratting);
        $json = CommentServices::makeMessageJson($request, $book, $book_id, $ratting);

        // Envia os dados para API
        ApiRequests::postRequestWithToken($token, $json, "/reviews");
        MessageGenerator::successMessage($request, "Comentário adicionado com sucesso");
        
        return redirect("/book/{$book_id}");
    }
}
