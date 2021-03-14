<?php


namespace Habib\Commentable;

use Habib\Commentable\Http\Controllers\CommentableController;

class Router
{
    /**
     * @return \Closure
     */
    public function routerCommentable():\Closure
    {
        return function (string $prefix = '', array $middleware = []) {
            // set prefix && set middleware

            $this->group([
                'middleware'=>(array)config('comment.middleware', $middleware),
                'namespace'=>'\Habib\Commentable\Http\Controllers',
                'prefix'=>(string)config('comment.route_prefix', $prefix)
            ],function () {

                $this->post('comments/{comment}', [CommentableController::class,'activeToggle'])->name('comment.active.toggle');
                $this->resource('comments', CommentableController::class);

            });
        };
    }

}
