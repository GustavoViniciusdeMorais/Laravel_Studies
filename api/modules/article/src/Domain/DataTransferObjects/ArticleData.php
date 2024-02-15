<?php

namespace GustavoMorais\Article\Domain\DataTransferObjects;

class ArticleData
{
    public function __construct(
        public string $title,
        public string $body
    ) {}

    public static function fromArray(array $data)
    {
        if (
            !is_array($data)
            || empty($data)
            || !isset($data['title'])
            || !isset($data['body'])
        ) {
            throw new \Exception('Invalid data');
        }
        return new self(
            $data['title'],
            $data['body']
        );
    }
}
