<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function add()
    {
        $data = [
            ["id" => 1, "name" => "News"],
            ["id" => 2, "name" => "Tech"],
        ];
        return view('articles.add', [
            'categories' => $data,
        ]);
    }

    public function create(Request $request)
    {

        $validator = validator($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect()->route('article.index');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Article deleted');
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view('articles.detail', compact('article'));
    }
}
