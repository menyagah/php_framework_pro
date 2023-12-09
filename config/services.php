<?php

$container = new \League\Container\Container();

$routes = include BASE_PATH . '/routes/web.php';

$container->add(
    MartinNyagah\Framework\Routing\RouterInterface::class,
MartinNyagah\Framework\Routing\Router::class
);

$container->extend(MartinNyagah\Framework\Routing\RouterInterface::class)
    ->addMethodCall('setRoutes', [new \League\Container\Argument\Literal\ArrayArgument($routes)]);

$container->add(MartinNyagah\Framework\Http\Kernel::class)
    ->addArgument(MartinNyagah\Framework\Routing\RouterInterface::class);
return $container;