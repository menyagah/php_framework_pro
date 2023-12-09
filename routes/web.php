<?php

use App\Controller\HomeController;
use App\Controller\PostsController;

return [
    ['POST', '/', [HomeController::class, 'index']],
    ['GET', '/posts/{id:\d+}', [PostsController::class, 'show']],
    ['GET', '/hello/{name:.+}', function (string $name) {
        return new \MartinNyagah\framework\src\Http\Response("Hello $name");
    }]
];
