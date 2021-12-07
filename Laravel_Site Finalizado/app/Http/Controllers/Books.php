<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ApiRequests;
use App\Http\Controllers\Controller;
use App\Http\Services\BooksServices;
use App\Http\Services\MessageGenerator;
use App\Http\Services\TokenFactory;

class Books extends Controller
{
    public function index(Request $request)
    {
        if (!BooksServices::verifyLogin($request)) {
            MessageGenerator::errorMessage($request, "Para acessar esta página deve-se estar logado!!");
            return redirect("/home");
        }

        if (!BooksServices::admVerify($request)) {
            MessageGenerator::errorMessage($request, "Você não tem acesso a essa página");
            return redirect("/home");
        }


        return view('routes.books.book_form', []);
    }

    public function createBook(Request $request)
    {
        $isbn = $request->book_isbn;
        $bookService = (new BooksServices());

        // Verifica se o isbn foi digitado com "-", sem sim, ele remove os "-"
        $isbn = $bookService->isbnFilter($isbn);

        // Verifica se o isbn é válido
        if ($bookService->regexVeryfier($isbn, $request) === false) {
            MessageGenerator::errorMessage($request, "Favor inserir um ISBN válido! O ISBN deve conter 13 numeros.");
            return redirect()->back();
        }

        $token = (new TokenFactory())->getToken($request);

        // Gera o json que será mandado para API
        $json = $bookService->createBookJson($request, $isbn);

        // Resposta da API
        $response = ApiRequests::postRequestWithToken($token, $json, "/books");

        // Verifica se livro já existe
        if ($response === "Book already exist") {
            $request->session()->flash("error_message", "Livro já existe!!! Favor insira outro.");
            return redirect("/book/create");
        }

        MessageGenerator::successMessage($request, "Livro inserido com sucesso.");
        return redirect("/book/create");
    }


    public function bookPage(Request $request, int $id)
    {
        $book = json_decode(ApiRequests::getRequest("/books/{$id}"), true);
        if ($book === "Book not found") {
            return redirect("/home");
        }

        if (BooksServices::verifyLogin($request) === false) {
            return view('routes.books.book_page', [
                "book" => $book
            ]);
        }

        $bookComments = json_decode(ApiRequests::getRequest("/reviews/{$id}/books"), true);

        if ($bookComments === "Reviews not found") {
            return view('routes.books.book_page', [
                "book" => $book,
                "comments" => $bookComments
            ]);
        }
        $arrayComments = BooksServices::createCommentsArray($request, $bookComments);

        return view('routes.books.book_page', [
            "book" => $book,
            "comments" => $arrayComments
        ]);
    }

    public function deleteBook(Request $request, int $book_id)
    {
        $token = (new TokenFactory())->getToken($request);

        if (ApiRequests::deleteRequest("/books/{$book_id}", $token) !== 200) {
            MessageGenerator::errorMessage($request, "Erro ao remover o livro !!");
            return redirect("/book/{$book_id}");
        }

        MessageGenerator::successMessage($request, "Livro excluido com sucesso");
        return redirect("/home");
    }
}
