<?php

spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . $className . '.php';
});

use BooksWebsiteProject\Controllers\BooksApiController;

try {
    $api = new BooksApiController();
    echo $api->run();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}