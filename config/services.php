<?php

$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(BASE_PATH . '/.env');



$container = new \League\Container\Container();

$container->delegate(new League\Container\ReflectionContainer(true));

$routes = include BASE_PATH . '/routes/web.php';
$appEnv = $_SERVER['APP_ENV'];
$templatesPath = BASE_PATH . './templates';



$container->add('APP_ENV', new \League\Container\Argument\Literal\StringArgument($appEnv));

$container->add(
    MartinNyagah\Framework\Routing\RouterInterface::class,
MartinNyagah\Framework\Routing\Router::class
);

$container->extend(MartinNyagah\Framework\Routing\RouterInterface::class)
    ->addMethodCall('setRoutes', [new \League\Container\Argument\Literal\ArrayArgument($routes)]);

$container->add(MartinNyagah\Framework\Http\Kernel::class)
    ->addArgument(MartinNyagah\Framework\Routing\RouterInterface::class)
    ->addArgument($container);


$container->addShared('filesystem-loader', \Twig\Loader\FilesystemLoader::class)
    ->addArgument(new \League\Container\Argument\Literal\StringArgument($templatesPath));
$container->addShared(\Twig\Environment::class)
    ->addArgument('filesystem-loader');
return $container;