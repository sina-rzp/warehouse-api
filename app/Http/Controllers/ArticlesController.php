<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Backpack\PageManager\app\Models\Page;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Meta;
use DB;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug_or_id = null)
    {

        $matchThese = ['status' => 'PUBLISHED'];
        $article = Article::with('tags')->whereSlug($slug_or_id)->where($matchThese)->first();

        if (count($article) == 0)
        {
            abort(404);
        }
        
        $values = Article::where($matchThese)->get(['meta_description','title'])->first();

        $latest = Article::published()->take(3)->get(['title','slug','thumbnail', 'created_at']);

        return view('articles.article', ['article' => $article, 
            'title' => $values->title , 
            'meta_description' => $values->meta_description, 
            'latest_articles' => $latest]);

        return $article;

    }


    public function tag ($slug_or_id = null)
    {
        $tag = Tag::whereSlug($slug_or_id)->get()->first();;

        if (!$tag)
        {
            abort(404);
        }

        $tag_id = $tag->id;

        $matchThese = ['status' => 'PUBLISHED'];

        $articles = Tag::find($tag_id)->articles()->where($matchThese)->paginate(10);

        $tags = Tag::has('articles')->get();

        $meta_description = Tag::where(['id' => $tag_id])->get(['meta_description'])->first();

        $metas = Meta::where('slug','journals')->get(['page_title', 'page_tagline'])->first();

        return view('articles.articles', ['articles' => $articles , 
            'title' => ucfirst($slug_or_id).' Articles' ,
            'page_title' => $metas->page_title,
            'page_tagline' => $metas->page_tagline, 
            'meta_description' => $meta_description->meta_description , 
            'tags' => $tags]);
        // return $articles;
    }

    public function all ()
    {
        $matchThese = ['status' => 'PUBLISHED'];

        $articles = Article::where($matchThese)->paginate(12);

        $tags = Tag::has('articles')->get();

        $metas = Meta::where('slug','journals')->get(['meta_description' , 'title' , 'page_title', 'page_tagline'])->first();

        return view('articles.articles', ['articles' => $articles ,
        'title' => $metas->title,
        'page_title' => $metas->page_title,
        'page_tagline' => $metas->page_tagline,
        'meta_description' => $metas->meta_description,
        'tags' => $tags ]);
        // return $articles;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
