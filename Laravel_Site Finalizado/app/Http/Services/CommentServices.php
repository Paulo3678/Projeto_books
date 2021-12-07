<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class CommentServices
{
    public static function makeMessageJson(Request $request, array $book, int $book_id, float $ratting)
    {
        return json_encode([
            "title" => "Comentario livro: " . $book["title"],
            "content" => $request->review_comment,
            "rating" => $ratting,
            "id_book" => $book_id,
            "id_user" => $request->session()->get("user_id")
        ]);
    }
}
