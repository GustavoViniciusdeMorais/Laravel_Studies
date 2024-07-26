# Builder Package

###
```
```

### ./config/app.php
```

'providers' => [
    Modules\Builder\Providers\GustavoPackageBuilderServiceProvider::class,
]

'aliases' => [
    'GustavoBuilder' => Modules\Builder\Facades\GustavoPackageBuilderFacade::class,
]

```

### ./composer.json
```

"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/",
            "Modules\\Builder\\": "modules/builder/src"
        }
    },

```

![TDD](./imgs/commandTest.png)
![TDD](./imgs/routeTest.png)
