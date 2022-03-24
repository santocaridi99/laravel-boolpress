<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // vedo i post solo dell'utente selezionato
        $posts = Post::where("user_id", Auth::user()->id)->get();
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // select di tutte le categorie
        $categories = Category::all();
        // select di tutti i tags
        $tags = Tag::all();
        // passo dati alla view
        return view("admin.posts.create", compact("categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // valido i dati provenienti dalla request
        $data = $request->validate([
            "title" => "required|min:3",
            "content" => "required|min:3",
            "category_id" => "nullable",
            "tags" => "nullable",
            // image può essere jpeg , png ecc massimo 500byte
            "image" => "nullable|mimes:jpg,jpeg,png,bmp|max:500"
        ]);
        // la validazione di tags va nella tabella tags e vede se c'è un id esistente relativo al tag
        // creo post

        // $post = new Post();
        // // passo i dati fillati al post
        // $post->fill($data);

        // posso scrivere direttamente
        $post = new Post($data);

        // genero slug dal titolo
        $slug = Str::slug($post->title);
        // controllo al db se esiste un elemento con lo stesso slug
        // facendo una query
        $exist = Post::where("slug", $slug)->first();
        // finchè esiste nel db genera un nuovo slug con un numero incrementato
        // dichiaro un contatore
        $counter = 1;
        while ($exist) {
            $newSlug = $slug . "-" . $counter;
            $counter++;
            // controllo se esiste anche quello nuovo 
            $exist = Post::where("slug", $newSlug)->first();
            // se esiste , salvo il nuovo slug nella variabile $slug
            if (!$exist) {
                $slug = $newSlug;
            }
        }
        // assegno valore di slug al nuovo post
        $post->slug = $slug;
        // passo l'id dell elemnto loggato per assegnare a user_id qualcosa 
        // sennò ho errore per valore di default mancante
        $post->user_id = Auth::user()->id;
        // se esiste image nel data
        if (key_exists("image", $data)) {
            // upload del file
            $post->image = Storage::put("images", $data["image"]);
        }
        // salvo
        $post->save();
        //  aggiungo le relazioni con i tag ricevuti
        // attach avviene dopo aver salvato,
        // così avrò l'id del nuovo post che viene creato dopo il save
        // non serve usare il detach qui
        if (key_exists("tags", $data)) {
            $post->tags()->attach($data["tags"]);
        }
        // redirect all'index
        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // invece di show uso lo slug
    public function show($slug)
    {
        $post = Post::where("slug", $slug)->first();
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //query su Post per controllare se già esiste elemebti slug
        $post = Post::where("slug", $slug)->first();
        // query su Category
        // che restituisce tutte le categorie
        $categories = Category::all();
        // query su tag che restituisce tutti i tag presenti nel db
        $tags = Tag::all();
        // alla view ora passo due variabili invece di una
        return view("admin.posts.edit", ["post" => $post, "categories" => $categories, "tags" => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // valido i dati provenienti dalla request
        $data = $request->validate([
            "title" => "required|min:3",
            "content" => "required|min:3",
            "category_id" => "nullable",
            "tags" => "nullable|exists:tags,id",
            "image" => "nullable|mimes:jpg,jpeg,png,bmp|max:500"
        ]);
        $post = Post::findOrFail($id);
        // se decido di cambiare il titolo
        // quindi quello presente nel database + diverso da quello inserito nella request
        if ($data["title"] !== $post->title) {
            // genero slug dal titolo
            $slug = Str::slug($data["title"]);
            // controllo al db se esiste un elemento con lo stesso slug
            // facendo una query
            $exist = Post::where("slug", $slug)->first();
            // finchè esiste nel db genera un nuovo slug con un numero incrementato
            // dichiaro un contatore
            $counter = 1;
            while ($exist) {
                $newSlug = $slug . "-" . $counter;
                $counter++;
                // controllo se esiste anche quello nuovo 
                $exist = Post::where("slug", $newSlug)->first();
                // se esiste , salvo il nuovo slug nella variabile $slug
                if (!$exist) {
                    $slug = $newSlug;
                }
            }
            $post->slug = $slug;
            $data["slug"] = $slug;
        }
        $post->update($data);
        // se data contiene l'img ,(file)
        if (key_exists("image", $data)) {
            // cancella quella vecchia
            if ($post->image) {
                Storage::delete($post->image);
            }
            $image = Storage::put("images", $data["image"]);
            $post->image = $image;
            $post->save();
        }
        // se la key tags esiste nel data fai il sync altrimenti niente
        // messo questo controllo perchè posso avere post senza tag
        if (key_exists("tags", $data)) {
            // sync fa prima un detach quindi elimina le vecchie relazioni
            // e mantiene quelle presenti nell'array
            // attach aggiunge le nuove relazioni
            $post->tags()->sync($data["tags"]);
        }
        return redirect()->route("admin.posts.show", $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
