<?php

namespace GustavoMorais\Article\Application\Queries;

use GustavoMorais\Article\Application\BaseAction;
use GustavoMorais\Article\Domain\Entity\Article;

class FilterArticleByTitleAction extends BaseAction
{
    public function execute()
    {
        $articles = [];
        if (!empty($this->data) && isset($this->data['title'])) {
            $title = $this->data['title'];
            $articles = Article::where('title', 'like', '%' . $title . '%')->get();
        }
        return $articles;
    }
}
