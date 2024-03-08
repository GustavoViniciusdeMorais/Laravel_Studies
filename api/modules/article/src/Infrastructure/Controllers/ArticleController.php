<?php

namespace GustavoMorais\Article\Infrastructure\Controllers;

use GustavoMorais\Article\Application\Queries\GetArticlesAction;
use GustavoMorais\Article\Application\Commands\CreateArticleAction;
use GustavoMorais\Article\Infrastructure\Controllers\BaseController;
use Illuminate\Http\Request;
use GustavoMorais\Article\Infrastructure\Graphql\ArticleResolver;
use GraphQL\Executor\Executor;
use GraphQL\Type\Definition\ResolveInfo;
use GustavoMorais\Article\Application\Queries\FilterArticleByTitleAction;
use GustavoMorais\Article\Infrastructure\Queue\Producer;
use GustavoMorais\Article\Infrastructure\Events\SearchedArticlesEvent;

class ArticleController extends BaseController
{
    public function listArticles()
    {
        try {
            $articles = (new GetArticlesAction())->execute();
            $producer = new Producer();
            $producer->produce("test@email.com", "Article reader");
            return $this->success($articles);
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function createArticle(Request $request)
    {
        try {
            return $this->success((new CreateArticleAction())->setData($request->all())->execute());
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function graphql(Request $request)
    {
        try {
            $response = [];
            $input = json_decode($request->getContent(), true);
            $query = $input['query'];
            $variables = isset($input['variables']) ? $input['variables'] : null;

            $this->setResolvers(ArticleResolver::resolve());
            $schema = \GraphQL\Utils\BuildSchema::build(file_get_contents(__DIR__ . '/../Graphql/schema.graphqls'));

            $result = \GraphQL\GraphQL::executeQuery($schema, $query, null, null, $variables);
            
            $result = $result->toArray();
            if (isset($result['data'])) {
                $response = $result['data'];
            }
            return $this->success($response);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    private function setResolvers($resolvers)
    {
        Executor::setDefaultFieldResolver(
            function ($source, $args, $context, ResolveInfo $info) use ($resolvers) {
                $fieldName = $info->fieldName;
                if (is_null($fieldName) || is_null($info->parentType)) {
                    throw new \Exception('Could not get $fieldName or $parentType from ResolveInfo');
                }
                $parentTypeName = $info->parentType->name;
                if (isset($resolvers[$parentTypeName])) {
                    $resolver = $resolvers[$parentTypeName];
                    if (is_array($resolver) && array_key_exists($fieldName, $resolver)) {
                        $value = $resolver[$fieldName];
                        return is_callable($value) ? $value(
                            $source,
                            $args,
                            $context,
                            $info
                        ) : $value;
                    }
                }
                return Executor::defaultFieldResolver($source, $args, $context, $info);
        });
    }

    public function filter(Request $request)
    {
        try {
            event(new SearchedArticlesEvent("Someone searched about articles"));
            return $this->success(
                (new FilterArticleByTitleAction())
                    ->setData($request->all())
                    ->execute()
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
