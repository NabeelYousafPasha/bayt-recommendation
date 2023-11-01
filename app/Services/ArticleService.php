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

    public function getArticleById($id)
    {
        return $this->articleRepository->findById($id);
    }

    public function createArticle(array $data)
    {
        return $this->articleRepository->create($data);
    }

    public function updateArticle($id, array $data)
    {
        return $this->articleRepository->updateArticle($id, $data);
    }

    public function deleteArticle($id)
    {
        return $this->articleRepository->deleteArticle($id);
    }

}
