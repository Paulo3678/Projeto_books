<?php

namespace App\Http\Services\Comments;

use Illuminate\Http\Request;
use App\Http\Services\Comments\Comment;
use App\Http\Services\MessageGenerator;

class SmallerThanZero extends Comment
{
    public function verifyComment($ratting)
    {
        if ($ratting <= 0) {
            return "A avaliação é menor que zero";
        }
        return $this->proximaAvaliacao->verifyComment($ratting);
    }
}
