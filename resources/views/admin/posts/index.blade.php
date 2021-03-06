@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Boolpress Posts

                    <a class="ms-auto link-danger" href="{{ route('admin.posts.deletedPosts') }}">Post cestinati</a>
                    <a class="ms-auto" href="{{ route('admin.posts.create') }}">Aggiungi Post +</a>
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
                                {{-- form  che permette di soft deletare un post--}}
                                <form action="{{ route('admin.posts.deleteThePost', $post->id) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Cestiono
                                    </button>
                                </form>
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