<?php

namespace MartinNyagah\Framework\Routing;

use MartinNyagah\Framework\Http\Request;
use Psr\Container\ContainerInterface;

interface RouterInterface
{
    public function dispatch(Request $request, ContainerInterface $container);

    public function setRoutes(array $routes): void;
}