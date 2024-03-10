<?php

namespace GustavoMorais\Article\Domain\Entity;

class Article
{
    private $id;
    private $uuid;
    private $title;
    private $body;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
        ];
    }

    public static function fromArray(array $data)
    {
        if (
            !is_array($data)
            || empty($data)
        ) {
            throw new \Exception('Invalid data');
        }
        $article = new self();

        if (isset($data['title'])) {
            $article->setTitle($data['title']);
        }
        if (isset($data['body'])) {
            $article->setBody($data['body']);
        }
        if (isset($data['id'])) {
            $article->setId($data['id']);
        }
        if (isset($data['uuid'])) {
            $article->setUuid($data['uuid']);
        }
        if (isset($data['created_at'])) {
            $article->setCreatedAt($data['created_at']);
        }
        if (isset($data['updated_at'])) {
            $article->setUpdatedAt($data['updated_at']);
        }
        if (isset($data['deleted_at'])) {
            $article->setDeletedAt($data['deleted_at']);
        }

        return $article;
    }

}

