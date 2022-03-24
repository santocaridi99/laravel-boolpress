@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Delete the post
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($posts as $post)
                        <li class="list-group-item d-flex align-items-center">
                            {{$post->title}}
                            <span class="ms-2">[{{$post->user->name}}]</span>
                            {{-- se la categoria del post è nulla allora do undefined sennò la categoria relativa --}}
                            {{-- category , perchè nel model ho creato funzione category quindi richiama la relazione e
                            quindi posso leggere title --}}
                            <span class="ms-2">Category:[{{($post->category===null)? "undefined" :
                                $post->category->title}}]</span>
                            {{-- se ci sono tags nel post allora faccio un foreach e stampo i nomi --}}
                            @if($post->tags)
                            @foreach ($post->tags as $tag)
                            <span class="ms-2">#{{$tag->name}}</span>
                            @endforeach
                            @endif
                            @if($post->created_at->diffInHours() > 12)
                            <span class="ms-3">{{$post->created_at->format('d-m-Y , H:i')}}</span>
                            @else
                            <span class="ms-3">{{$post->created_at->diffForHumans()}}</span>
                            @endif
                            <div class="ms-auto">
                                <a class="ms-auto btn btn-outline-primary btn-sm"
                                    href="{{ route('admin.posts.show', $post->slug) }}">Mostra</a>
                                {{-- form --}}
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Elimina
                                    </button>
                                </form>
                                <a class="ms-auto btn btn-outline-success btn-sm"
                                    href="{{ route('admin.posts.restore', $post->id) }}">Restore</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection