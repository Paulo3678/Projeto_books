<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ApiRequests;
use App\Http\Controllers\Controller;
use App\Http\Services\MessageGenerator;

class Home extends Controller
{
    public function index()
    {
        return view("routes.home.index", []);
    }

    public function searchBook(Request $request)
    {
        $bookName = $request->book_name;
        $bookName = $this->removeAcentos($bookName);
        
        $book = ApiRequests::getBookByName($bookName);

        if ($book ===  "Book not found") {
            MessageGenerator::errorMessage($request, "Livro não encontrado!! Favor não utilizar caracteres especiais ou acentos.");
            return redirect("/home");
        }

        $request->session()->flash("search_result", $book);

        return redirect("/home");
    }
}
