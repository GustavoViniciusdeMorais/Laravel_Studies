# Package Configuration

### api/modules/article/composer.json
```json
{
    "name": "gustavomorais/article",
    "version": "1.0.0",
    "description": "Article package",
    "type": "library",
    "license": "MIT",
    "autoload": {
        "psr-4": {
            "GustavoMorais\\Article\\": "src"
        }
    },
    "authors": [
        {
            "name": "Gustavo Vinicius"
        }
    ],
    "require": {},
    "extra": {
        "laravel": {
            "providers": [
                "GustavoMorais\\Article\\Providers\\ArticleProvider"
            ],
            "aliases": {
                "Location": "GustavoMorais\\Article\\Facades\\ArticleFacade"
            }
        }
    }
}
```

### api/modules/article/src/Providers/ArticleProvider.php
```php
<?php

namespace GustavoMorais\Article\Providers;

use Illuminate\Support\ServiceProvider;
use GustavoMorais\Article\Article;

class ArticleProvider extends ServiceProvider
{
    public function boot()
    {
        // code...
    }

    public function register()
    {
        $this->app->singleton('article', function($app){
            return new Article();
        });
    }
}
```

### api/modules/article/src/Facades/ArticleFacade.php
```php
<?php

namespace GustavoMorais\Article\Facades;

use Illuminate\Support\Facades\Facade;

class ArticleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'article';
    }
}
```

### api/modules/article/src/Article.php
```php
<?php

namespace GustavoMorais\Article;

class Article
{
    public function check():?string
    {
        return "article test";
    }
}
```

### api/composer.json
```json
"repositories": [
        {
          "type": "path",
          "url": "modules/article"
        }
      ],
```

### Import package
```sh
composer require gustavomorais/article
```

### api/bootstrap/app.php
```php
$app->withFacades(true, [
    'GustavoMorais\Article\Facades\ArticleFacade' => 'Article'
]);
```

### api/bootstrap/app.php
```php
$app->register(GustavoMorais\Article\Providers\ArticleProvider::class);
```

### api/app/Http/Controllers/ArticleController.php
```php
<?php

namespace App\Http\Controllers;

use Article;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function listArticles()
    {
        return new JsonResponse([
            Article::check()
        ], 200);
    }
}
```

### api/routes/web.php
```php
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/articles', [
        'as' => 'articles', 'uses' => 'ArticleController@listArticles'
    ]);
});
```

### Request
```sh
sudo curl --request GET localhost/api/articles
```
