<?php

namespace MartinNyagah\Framework\Routing;

use FastRoute\RouteCollector;
use MartinNyagah\Framework\Http\Request;
use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{

    public static function dispatch(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector){
            $routes = include BASE_PATH . '/routes/web.php';

            foreach ($routes as $route){
                $routeCollector->addRoute(...$route);
            }

        });

       $routeInfo = $dispatcher->dispatch(
           $request->getMethod(),
           $request->getPathInfo()
       );
       [$status,[$controller, $method], $vars] = $routeInfo;
        return [[new $controller, $method], $vars];
    }
}