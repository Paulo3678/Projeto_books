<?php

namespace App\Http\Services\Comments;

use App\Http\Services\Comments\Comment;

class BiggerThanFive extends Comment
{
    public function verifyComment($ratting)
    {
        if ($ratting > 5.0) {
            return "A avaliação é maior que 5!";
        }
        return $this->proximaAvaliacao->verifyComment($ratting);
    }
}
