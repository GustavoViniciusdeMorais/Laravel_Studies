<?php

require __DIR__ . '/vendor/autoload.php';

use GustavoMorais\Article\Infrastructure\Queue\Consumer;

$consumer = new Consumer();
$consumer->consume();
