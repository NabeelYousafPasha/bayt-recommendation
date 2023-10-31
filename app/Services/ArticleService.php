<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticleService
{
    /**
     * @var ArticleRepository
     */
    protected ArticleRepository $articleRepository;


    /**
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    /**
     * @return Collection|LengthAwarePaginator|array
     */
    public function get(): Collection|LengthAwarePaginator|array
    {
        return $this->articleRepository->getAllArticlesWithCategories(paginate: true);
    }

}
