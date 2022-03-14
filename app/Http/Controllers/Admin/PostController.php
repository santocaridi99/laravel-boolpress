<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
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
        $posts = Post::all();
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.posts.create");
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
            "content" => "required|min:3"
        ]);
        // creo post
        $post = new Post();
        // passo i dati fillati al post
        $post->fill($data);
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
        $post->save();
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
    public function edit($id)
    {
        //
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
            "content" => "required|min:3"
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
            $post ->slug = $slug;
            $data["slug"] = $slug;
        }

        $post->update($data);
        return redirect()->route("admin.posts.show",$post->id);
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
