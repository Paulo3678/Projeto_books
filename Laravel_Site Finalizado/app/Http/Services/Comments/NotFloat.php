<?php

namespace App\Http\Services\Comments;

use Illuminate\Http\Request;
use App\Http\Services\Comments\Comment;
use App\Http\Services\MessageGenerator;

class NotFloat extends Comment
{
    public function verifyComment($ratting)
    {
        if (!is_float($ratting)) {
            return "Avaliação inválida";
        }

        return $this->proximaAvaliacao->verifyComment($ratting);
    }
}
