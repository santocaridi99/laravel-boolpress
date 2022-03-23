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
                    <div class="my-3">
                        {{-- stampo data formattata --}}
                        @php
                        use Carbon\Carbon;
                        @endphp
                        <p> Data Creazione : @if($post->created_at->diffInHours() > 12)
                            {{$post->created_at->format('d-m-Y , H:i')}} @else {{$post->created_at->diffForHumans()}}
                            @endif </p>
                        <p>Data ultima Modifica : @if($post->created_at->diffInHours() > 12)
                            {{$post->created_at->format('d-m-Y , H:i')}} @else {{$post->created_at->diffForHumans()}}
                            @endif </p>

                    </div>
                    {{-- se la categoria non è nulla la stampo insieme alla descrizione --}}
                    {{-- come scritto in index scrivo category , perchè nel model ho creato funzione category quindi
                    richiama la relazione e quindi posso leggere title e description --}}
                    @if($post->category !== null)
                    <div class="my-3">
                        <p>Categoria: {{$post->category->title}}</p>
                        <p>Descrizione: {{$post->category->description}}</p>
                    </div>
                    @endif
                    {{-- se non c'è immagine nmetto un placeholder --}}
                    <div class="my-3">
                        @if($post->image === null)
                        <img src="https://blumagnolia.ch/wp-content/uploads/2021/05/placeholder-126-300x200.png"
                            alt="dummy">
                        @else  <img src="{{asset("storage/".$post->image)}}" alt="{{$post->title}}" class="img-fluid">
                        @endif
                    </div>
                    {{-- ugualmente a category lavoro con i tags --}}
                    {{-- che è un array collection --}}
                    @if($post->tags)
                    <div class="my-3">
                        @foreach ($post->tags as $tag)
                        <span>#{{$tag->name}}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection