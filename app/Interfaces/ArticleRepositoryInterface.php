<?php

namespace App\Interfaces;

interface ArticleRepositoryInterface
{
    public function getAllArticles();

    public function getAllArticlesWithCategories();

    public function updateArticle($articleId, array $newDetails);

    public function deleteArticle($articleId);
}
