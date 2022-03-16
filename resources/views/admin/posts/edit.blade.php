@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Modifica Post
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
                        @csrf
                        @method("patch")

                        {{-- titolo --}}
                        <div class="mb-3">
                            <label>Titolo</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                placeholder="Inserisci il titolo" value="{{ old('title', $post->title)}}" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- contenuto del post --}}
                        <div class="mb-3">
                            <label>Contenuto</label>
                            <textarea name="content" rows="10"
                                class="form-control @error('content') is-invalid @enderror"
                                placeholder="Inserire testo..."
                                required>{{ old('content' , $post->content )}}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- select per le categorie --}}
                        <div class="mb-4">
                            <label>Categorie</label>
                            <select name="category_id" class="form-select">
                                {{-- value vuota --}}
                                <option value="">-- Nessuna Categoria --</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{-- se il category post è strettamente uguale all'
                                    id della categoria metto selected --}} @if ($post->category_id === $category->id)
                                    selected
                                    @endIf>
                                    {{-- stamoi titolo della categoria --}}
                                    {{ $category->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label>Modifica tabella</label>
                            @foreach ($tags as $tag)
                            {{-- creo delle form check --}}
                            {{-- con value id --}}
                            <div class="form-check form-check-inline">
                                {{-- assegnando un id ,sia all' input sia label con il for al click della label si
                                checka l'input --}}
                                {{-- mettendo le parentesi quadre al name , al server i dati arrivano sotto forma di
                                array --}}
                                {{-- se nell'array tags è gia presente tag allora metti checked altrimenti niente --}}
                                <input class="form-check-input" type="checkbox" value="{{$tag->id}}"
                                    id="tag_{{$tag->id}}" name="tags[]" {{$post->tags->contains($tag) ? 'checked' : ''}}>
                                {{-- contenuto è il nome del tag --}}
                                <label class="form-check-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                            </div>
                            @endforeach

                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-secondary">Annulla</a>
                            <button type="submit" class="btn btn-success">Salva post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection