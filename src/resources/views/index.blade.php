@extends('layouts::layouts.layout')
@section('content')
    <div class="card">
        <div class="card-body" style="min-height:650px ">
            <h4 class="card-title">Comments</h4>
            <table class="table table-striped table-inverse">
                <thead class="thead-default">
                <tr class="text-capitalize">
                    <th>id</th>
                    <th>comment</th>
                    <th>author</th>
                    <th>type</th>
                    <th>type id</th>
                    <th>reply</th>
                    <th>created at</th>
                    <th>active</th>
                    <th>delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td scope="row">{{$comment->id}}</td>
                        <td><a type="button" title="{{$comment->comment}}"> {{substr($comment->comment,0,20)}} </a></td>
                        <td>{{$comment->user->name ?? ''}}</td>
                        <td>{{$comment->commentable_type ?? ''}}</td>
                        <td>{{$comment->commentable_id ?? ''}}</td>
                        <td>{{$comment->comment_id ?? 'Parent'}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>
                            <button type="button"
                                    onclick="confirm('{{$comment->active?'detective':'active'}} comment')?commentsActive{{$comment->id}}.submit():''"
                                    class="btn-sm btn-{{$comment->active?'danger':'success'}} btn">{{$comment->active?'detective':'active'}}</button>
                            <form
                                action="{{action('\Habib\Commentable\Http\Controllers\CommentableController@activeToggle',$comment)}}"
                                method="post" name="commentsActive{{$comment->id}}">@csrf</form>
                        </td>
                        <td>
                            <button type="button"
                                    onclick="confirm('destroy comment')?comments{{$comment->id}}.submit():''"
                                    class="btn-sm btn-danger btn">delete
                            </button>
                            <form
                                action="{{action('\Habib\Commentable\Http\Controllers\CommentableController@destroy',$comment)}}"
                                method="post" name="comments{{$comment->id}}">@csrf @method('DELETE')</form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$comments->withQueryString()->links()}}
        </div>
    </div>
@stop
