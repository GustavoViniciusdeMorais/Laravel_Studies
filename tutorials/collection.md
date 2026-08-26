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
#### The chain filters odd-id products, maps them to uppercase names, reindexes keys with values(), and converts to a plain array with all().
```php
<?php
use Illuminate\Support\Collection;

$products = new Collection([
    ['id' => 1, 'name' => 'Notebook'],
    ['id' => 2, 'name' => 'Mouse'],
    ['id' => 3, 'name' => 'Keyboard'],
]);

$result = $products
    ->filter(fn ($product) => $product['id'] % 2 !== 0)  // only odd ids
    ->map(fn ($product) => [
        'id'   => $product['id'],
        'name' => strtoupper($product['name']),
    ])
    ->values()
    ->all();

// Result: [['id' => 1, 'name' => 'NOTEBOOK'], ['id' => 3, 'name' => 'KEYBOARD']]
```
