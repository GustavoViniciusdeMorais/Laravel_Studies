# Illuminate Collection

- [Doc](https://laravel.com/docs/10.x/collections)

```bash
php artisan tinker
```
```bash
php -a
require 'vendor/autoload.php';
$productsCollection = new Illuminate\Support\Collection();
```
```php
use Illuminate\Support\Collection;

$productsCollection = new Collection();

//$products = [['id' => 1,'name' => 'test1'],['id' => 2,'name' => 'test2']];
$products = [
    [
        'id' => 1,
        'name' => 'test1'
    ],
    [
        'id' => 2,
        'name' => 'test2'
    ]
];

$productsCollection->put('data', $products);

$productsCollection = $productsCollection->sort();

$productsCollection->values()->all();

```
