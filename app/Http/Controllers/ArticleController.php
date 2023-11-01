<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModelRatingRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ArticleController extends Controller
{

    /**
     * @var ArticleService
     */
    private ArticleService $articleService;

    /**
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        $articles = $this->articleService->get();

        return view('article.index')->with([
            'articles' => $articles,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('article.show')
            ->with([
                'article' => $article,

                'ratingCount' => $article->ratingsCount(),
                'ratingAvg' => number_format($article->ratingsAvg()),
            ]);
    }

    public function rate(ModelRatingRequest $request, Article $article)
    {
        $article->rateOnce($article->user_id, $request->rating);

        return redirect()->route('articles.show', ['article' => $article->id]);
    }
}
