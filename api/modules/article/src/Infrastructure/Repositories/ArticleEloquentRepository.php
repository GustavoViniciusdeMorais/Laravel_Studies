<?php

namespace GustavoMorais\Article\Infrastructure\Repositories;

use GustavoMorais\Article\Domain\Repositories\ArticleRepository;
use GustavoMorais\Article\Domain\Entity\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use GustavoMorais\Article\Infrastructure\Observers\ArticleObserver;

#[ObservedBy(ArticleObserver::class)]
class ArticleEloquentRepository extends Model implements ArticleRepository
{
    use HasUuids, SoftDeletes;

    protected $table = 'articles';
    protected $fillable = ['id', 'uuid', 'title', 'body', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function saveEntity(Article $article): Article
    {
        $this->create($article->toArray());
        return $article;
    }

    public function findEntities(Article $article)
    {
        $query = $this->query();

        if ($article->getTitle() !== null) {
            $query->where('title', 'like', '%' . $article->getTitle() . '%');
        }

        if ($article->getBody() !== null) {
            $query->where('body', 'like', '%' . $article->getBody() . '%');
        }

        if ($article->getCreatedAt() !== null) {
            $query->whereDate('created_at', $article->getCreatedAt());
        }

        if ($article->getUpdatedAt() !== null) {
            $query->whereDate('updated_at', $article->getUpdatedAt());
        }

        if ($article->getDeletedAt() !== null) {
            $query->whereDate('deleted_at', $article->getDeletedAt());
        }

        return $query->get();
    }

    public function findAll():array
    {
        return $this->all()->toArray();
    }
}
