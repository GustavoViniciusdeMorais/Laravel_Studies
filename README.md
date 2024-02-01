# Location Package

## Install
```

https://packagist.org/packages/redninjaturtle/red-laravel-location

composer require redninjaturtle/red-laravel-location

# Remember to add the kernel config explained below.

```

### ./modules/Location/Providers/LocationServiceProvider.php
```

public function boot()
{
    Route::middleware(['web'])
        ->group(__DIR__ . '/../Routes/web.php');
    
    $this->loadTranslationsFrom(__DIR__ . '/../lang', 'Location');
}

```

### ./modules/Pages/Views/index.blade.php
```

<strong>{{ trans('Location::pages.title') . ' test' }}</strong>

```

### ./config/app.php
```

'providers' => [
    /*
    * Package Service Providers...
    */
    Modules\Pages\Providers\PageServiceProvider::class,
    Redninjaturtle\RedLaravelLocation\Providers\LocationServiceProvider::class,
],

```

### ./app/Http/Kernel.php
```

protected $middlewareGroups = [
    'web' => [
        \Redninjaturtle\RedLaravelLocation\Http\Middleware\Locale::class,
    ],
];

```

![TDD](/imgs/locationPack.png)

## Facade

### ./modules/Location/Location.php
```

namespace Redninjaturtle\RedLaravelLocation;

class Location
{

    private $locale = 'en';

    public function __construct($locale = 'en')
    {
        $this->locale = $locale;
    }

    public function getLocation()
    {
        return $this->locale;
    }
}

```

### ./modules/Location/Facades/LocationFacade.php
```

namespace Redninjaturtle\RedLaravelLocation\Facades;

use Illuminate\Support\Facades\Facade;

class LocationFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'location';
    }
}

```

### ./modules/Location/Providers/LocationServiceProvider.php
```

public function register()
{
    $this->app->singleton('location', function($app){
        return new Location('pt-br');
    });
}

```

### ./config/app.php
```

'aliases' => [
    'Location' => Redninjaturtle\RedLaravelLocation\Facades\LocationFacade::class,
],

```

### ./app/Http/Controllers/TestController.php
```
use Location;

class TestController extends Controller
{
    
    public function index()
    {
        $location = Location::getLocation();
        return view('tests.index')->with(['location' => $location]);
    }
}
```
