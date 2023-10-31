<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ArticleRepository implements ArticleRepositoryInterface
{
    private Model $model;

    public function __construct()
    {
        $this->model = new Article();
    }

    /**
     * @param bool $paginate
     * @param int $perPage
     * @return mixed
     */
    public function getAllArticles(bool $paginate = false, int $perPage = 10): mixed
    {
        $articles = $this->model;

        if ($paginate) {
            return $articles->paginate($perPage);
        }

        return $articles->get();
    }

    /**
     * @param $articleId
     * @return mixed
     */
    public function getArticleById($articleId): mixed
    {
        return $this->model->findOrFail(decryptId($articleId));
    }

    /**
     * @param $articleId
     * @return int
     */
    public function deleteArticle($articleId): int
    {
        return $this->model->destroy(decryptId($articleId));
    }

    /**
     * @param array $articleDetails
     * @return mixed
     */
    public function createArticle(array $articleDetails): mixed
    {
        return $this->model->create($articleDetails);
    }

    /**
     * @param $articleId
     * @param array $newDetails
     * @return mixed
     */
    public function updateArticle($articleId, array $newDetails): mixed
    {
        return $this->model->whereId(decryptId($articleId))
            ->update($newDetails);
    }

    /**
     * @param bool $paginate
     * @param int $perPage
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function getAllArticlesWithCategories(bool $paginate = false, int $perPage = 10): Collection|LengthAwarePaginator|array
    {
        $articles =  $this->model->with('categories');

        if ($paginate) {
            return $articles->paginate($perPage);
        }

        return $articles->get();
    }
}
