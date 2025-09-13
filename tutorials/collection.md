# Illuminate Collection

- [Doc](https://laravel.com/docs/10.x/collections)

```bash
php artisan tinker
```
```bash
php -a
require 'vendor/autoload.php';

$list2 = new Illuminate\Support\Collection();

$list2->push(['id'=>1,'name'=>'test']);
$list2->push(['id'=>2,'name'=>'test2']);

$list2->each(function($item) { print_r($item['name']); });
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
