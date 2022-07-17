@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <p class="text-muted">Category: {{ $article->category->name }}</p>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <p class="card-text">{{ $article->content }}</p>
                <a class="btn btn-warning" href="{{ route('article.destroy', $article->id) }}">
                    Delete
                </a>
            </div>
        </div>

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif


        @auth
            <div class="card mb-2 p-2">
                <form action="{{ route('comment.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group">
                        <label for="comment" class="mb-2 text-muted">Comment Here...</label>
                        <textarea name="content" class="form-control" id="comment" cols="10" rows="3">

                    </textarea>
                    </div>

                    <button type="submit" class="btn btn-dark btn-sm my-2 float-end">Send</button>
                </form>
            </div>

        @endauth

        <div class="card mb-2">
            <div class="card-header bg-info text-white">
                Comments ({{ count($article->comments) }})
            </div>
            @foreach ($article->comments as $comment)
                <div class="card-body border-bottom">
                    <div class="d-flex justify-content-between">
                        <span class="text-dark">
                            {{ $comment->content }}
                        </span>
                        @auth
                            @if ($comment->user_id == auth()->user()->id)
                                <a href="{{ route('comment.delete', $comment->id) }}" class="btn">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                </a>
                            @endif
                        @endauth
                    </div>
                    <p>By {{ $comment->user->name }}, <span
                            class="text-muted">{{ $comment->updated_at->diffForHumans() }}</span> </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
