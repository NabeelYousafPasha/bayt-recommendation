<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository as Repository;

class ArticleRepository extends Repository implements ArticleRepositoryInterface
{
    /**
     * @var Model|Article
     */
    private Model $model;


    public function __construct()
    {
        $this->model = new Article();
        parent::__construct($this->model);
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

        return $this->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function createArticle(array $data): mixed
    {
        return $this->create($data);
    }

    /**
     * @param $articleId
     * @param array $newDetails
     *
     * @return mixed
     */
    public function updateArticle($articleId, array $newDetails): mixed
    {
        return $this->update(decryptId($articleId), $newDetails);
    }

    /**
     * @param $articleId
     * @return int
     */
    public function deleteArticle($articleId): int
    {
        return $this->delete(decryptId($articleId));
    }

    /**
     * @param bool $paginate
     * @param int $perPage
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function getAllArticlesWithCategories(bool $paginate = false, int $perPage = 10): Collection|LengthAwarePaginator|array
    {
        $articles = $this->model->with('categories');

        if ($paginate) {
            return $articles->paginate($perPage);
        }

        return $this->get();
    }

    /**
     * @param $articleId
     * @return mixed
     */
    public function getArticleById($articleId): mixed
    {
        return $this->model->findOrFail(decryptId($articleId));
    }
}
