<?php


namespace Habib\Commentable\Http\Controllers;

use Exception;
use Habib\Commentable\Models\Commentable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\View\View;
use LaravelIdea\Helper\Habib\Commentable\Models\_CommentableQueryBuilder;

class CommentableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|_CommentableQueryBuilder
     */
    public function index()
    {
        $comment = Commentable::query()
            ->SearchComment('user_id')
            ->SearchComment('commentable_id')
            ->SearchComment('commentable_type')
            ->SearchComment('comment', true);

        return request()->ajax() ? $comment->paginate() : view('commentable::index', ['comments' => $comment->paginate()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Commentable $comment
     * @return Model
     */
    public function store(Request $request, Commentable $comment = null)
    {
        $validated = $request->validate(config('comment.validate_create', []));
        if ($comment->id) {
            return $comment->comments()->create($validated);
        }
        return Commentable::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param Commentable $comment
     * @return Commentable|Commentable
     */
    public function show(Commentable $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Commentable $comment
     * @return Commentable|Commentable
     */
    public function update(Commentable $comment)
    {
        $comment->update(request()->validate(config('comment.validate_update', [])));
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Commentable $comment
     * @return bool
     * @throws Exception
     */
    public function destroy(Commentable $comment)
    {
        $comment->delete();
        return back()->withSuccess('destroy comment');
    }

    public function activeToggle(Commentable $comment)
    {
        $comment->ActiveToggle()->save();
        return back()->withSuccess('active comment');
    }
}
