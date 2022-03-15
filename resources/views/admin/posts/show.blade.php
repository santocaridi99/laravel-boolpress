@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Dettagli post {{ $post->title }}
                    <a class="ms-auto" href="{{ route('admin.posts.edit', $post->slug) }}">Modifica</a>
                </div>

                <div class="card-body">
                    {{-- stampo content del post --}}
                    <h1>{{ $post->content }}</h1>
                    <div class="my-3">
                        {{-- stampo utente --}}
                        <p> Scritto da : {{$post->user->name}}</p>
                    </div>
                    {{-- se la categoria non è nulla la stampo insieme alla descrizione --}}
                    {{-- come scritto in index scrivo category , perchè nel model ho creato funzione category  quindi richiama la relazione e quindi posso leggere title e description --}}
                    @if($post->category !== null)
                    <div class="my-3">
                        <p>Categoria: {{$post->category->title}}</p>
                        <p>Descrizione: {{$post->category->description}}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection