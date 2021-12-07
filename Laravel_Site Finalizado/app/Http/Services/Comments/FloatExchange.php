<?php

namespace App\Http\Services\Comments;

use App\Http\Services\Comments\Comment;

class FloatExchange extends Comment
{
    public function verifyComment($ratting)
    {
        if (!floatval($ratting)) {
            return "Avaliação inválida!! A avaliação deve ser um número real!";
        }

        return $this->proximaAvaliacao->verifyComment($ratting);
    }
}
