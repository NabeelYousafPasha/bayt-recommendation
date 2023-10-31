<?php

namespace App\Interfaces;

interface ArticleRepositoryInterface
{
    public function getAllArticles();

    public function getArticleById($articleId);

    public function createArticle(array $articleDetails);

    public function updateArticle($articleId, array $newDetails);

    public function deleteArticle($articleId);

    public function getAllArticlesWithCategories();
}
