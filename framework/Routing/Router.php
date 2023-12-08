<?php

namespace MartinNyagah\Framework\Routing;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use MartinNyagah\Framework\Http\HttpException;
use MartinNyagah\Framework\Http\HttpRequestMethodException;
use MartinNyagah\Framework\Http\Request;
use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{

    public function dispatch(Request $request): array
    {
        $routeInfo = $this->extractRouteInfo($request);
        [$handler, $vars] = $routeInfo;

        if (is_array($handler)) {
            [$controller, $method] = $handler;
            $handler = [new $controller, $method];
        }

        return [$handler, $vars];
    }

    private function extractRouteInfo(Request $request): array
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

        switch ($routeInfo[0]){
            case Dispatcher::FOUND:
                return [$routeInfo[1], $routeInfo[2]];
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(',', $routeInfo[1]);
                throw new HttpRequestMethodException("The allowed methods are $allowedMethods");
            default:
                throw new HttpException("Not Found");
        }
    }
}