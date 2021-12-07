<?php

namespace App\Http\Services\Comments;

abstract class Comment
{
    protected ?Comment $proximaAvaliacao;

    public function __construct(?Comment $avaliacao)
    {
        $this->proximaAvaliacao = $avaliacao;
    }

    abstract public function verifyComment($ratting);
}
