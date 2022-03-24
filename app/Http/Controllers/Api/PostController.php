<?php

namespace App\Http\Controllers\Api;

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
    // uso request per poter leggere il query string
    public function index(Request $request)
    {
        // filtro
        // input è un modo per leggere una sola chiave della request
        $filter = $request->input("filter");
        if ($filter) {
            // query del filter e paginate (title like filter)
            $posts = Post::where("title", "LIKE", "%$filter%")->paginate(6);
        } else {
            // 6 post per pagina
            $posts = Post::paginate(6);
        }
        // recupero dato della relazione user con load dato che ho  già istanza del model
        $posts->load("user", "category");
        // faccio un each di ogni post
        // e se il post ha un img sostituisco il valore con url completo
        $posts->each(function ($post) {
            if ($post->image) {
                $post->image = asset("storage/" . $post->image);
            }
        });
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // allo show mostro lo slug
    public function show($slug)
    {
        $post = Post::where("slug", $slug)->with(["tags", "user", "category"])->first();
        // se non c'è il post lanciare un 404
        if (!$post) {
            abort(404);
        }
        if ($post->image) {
            $post->image = asset("storage/" . $post->image);
        }else{
            $post->image = "https://blumagnolia.ch/wp-content/uploads/2021/05/placeholder-126-300x200.png";
        }
        //   ritorno json
        return response()->json($post);
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
        //
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
