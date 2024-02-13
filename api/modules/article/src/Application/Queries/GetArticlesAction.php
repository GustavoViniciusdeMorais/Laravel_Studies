<?php

namespace GustavoMorais\Article\Application\Queries;

use GustavoMorais\Article\Application\BaseAction;
use GustavoMorais\Article\Domain\Entity\Article;

class GetArticlesAction extends BaseAction
{
    public function execute()
    {
        return Article::all();
    }
}
