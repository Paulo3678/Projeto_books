<?php

namespace App\Http\Services\Comments;

use App\Http\Services\Comments\Comment;

class EveryOk extends Comment
{
    public function __construct()
    {
        parent::__construct(null, null);
    }

    public function verifyComment($ratting)
    {
        return "Tudo ok";
    }
}
