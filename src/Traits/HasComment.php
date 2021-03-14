<?php

namespace Habib\Commentable\Traits;

use Habib\Commentable\Models\Commentable;

trait HasComment
{

    public function activeComments()
    {
        return $this->comments()->ActiveStatus(true);
    }

    public function comments()
    {
        return $this->morphMany(config('comment.comment_class', Commentable::class), config('comment.morph_name', 'commentable'));
    }

    public function notActiveComments()
    {
        return $this->comments()->ActiveStatus(false);
    }
}
