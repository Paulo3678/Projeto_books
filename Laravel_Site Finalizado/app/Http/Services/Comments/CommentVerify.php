<?php

namespace App\Http\Services\Comments;

use App\Http\Services\Comments\EveryOk;
use App\Http\Services\Comments\BiggerThanFive;
use App\Http\Services\Comments\FloatExchange;;

use App\Http\Services\Comments\SmallerThanZero;

class CommentVerify
{
    public function verificarComentarios($ratting)
    {
        $cadeiaDeVerificacao = new FloatExchange(new BiggerThanFive(new SmallerThanZero(new EveryOk())));

        return $cadeiaDeVerificacao->verifyComment($ratting);
    }
}
