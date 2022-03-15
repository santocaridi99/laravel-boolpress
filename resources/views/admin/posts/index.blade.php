@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Boolpress Posts

                    <a class="ms-auto" href="{{ route('admin.posts.create') }}">Aggiungi Post +</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($posts as $post)
                        <li class="list-group-item d-flex align-items-center">
                            {{$post->title}}
                            <span class="ms-2">[{{$post->user->name}}]</span>
                            {{-- se la categoria del post è  nulla allora do undefined sennò la categoria relativa --}}
                            {{-- category , perchè nel model ho creato funzione category  quindi richiama la relazione e quindi posso leggere title --}}
                            <span class="ms-2">Category:[{{($post->category===null)? "undefined" : $post->category->title}}]</span>
                            <a class="ms-auto" href="{{ route('admin.posts.show', $post->slug) }}">Mostra</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection