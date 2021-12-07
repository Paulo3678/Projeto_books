<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Services\ApiRequests;
use App\Http\Services\TokenFactory;
use GuzzleHttp\RetryMiddleware;

class BooksServices
{
    public function regexVeryfier($isbn, Request $request)
    {
        // Nº de 0 até 9, 13 nº seguidos
        // 1234567897894
        $regex = "/[0-9]{12}$/";
        if (!preg_match($regex, $isbn)) {
            return false;
        }
        return true;
    }

    public static function verifyLogin(Request $request): bool
    {
        if (!$request->session()->has("logado")) {
            if ($request->session()->get("logado") !== true) {
                return false;
            }
        }
        return true;
    }

    public static function createCommentsArray(Request $request, array $bookComments)
    {
        $arrayComments = [];

        foreach ($bookComments as $comment) {
            $user = json_decode(ApiRequests::getRequestWithToken("/users/" . $comment['id_user'], (new TokenFactory())->getToken($request)), true);
            $userName = ["user_name" => $user["name"]];
            $arrayComments[] = array_merge($comment, $userName);
        }
        return $arrayComments;
    }

    public function createBookJson(Request $request, $isbn)
    {
        $published_date = $request->book_published_date;
        $date = strtotime($published_date);
        $finalDate = date("m-d-Y", $date);

        $authors = null;
        $authors = str_contains($request->book_authors, ",") === true ?
            explode(",", $request->book_authors) :
            $authors = [$request->book_authors];


        $json = json_encode([
            "title" => $this->removeAcentos($request->book_title),
            "publisher" => $request->book_publisher,
            "published_date" => $finalDate,
            "rating" =>  floatval($request->book_ratting),
            "page_count" =>  intval($request->book_pages_count),
            "description" => $request->book_description,
            "isbn" => $request->book_isbn,
            "image_link" =>  $request->book_image_link,
            "authors" => $authors
        ]);

        return $json;
    }

    public static function isbnFilter($isbn)
    {
        if (str_contains($isbn, "-")) {
            $isbn = str_replace("-", "", $isbn);
        }
        return $isbn;
    }

    public static function admVerify(Request $request)
    {
        if (!$request->session()->has("admin")) {
            return false;
        }

        if ($request->session()->get("admin") === false) {
            return false;
        }


        return true;
    }

    private function removeAcentos(string $string)
    {
        return str_replace(
            "ç",
            'c',
            preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string)
        );
    }
}
