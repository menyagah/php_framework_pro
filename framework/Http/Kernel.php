<?php

namespace MartinNyagah\Framework\Http;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handle(Request $request): Response
    {

        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector){
            $routes = include BASE_PATH . '/routes/web.php';

            foreach ($routes as $route){
                $routeCollector->addRoute(...$route);
            }
//            $routeCollector->addRoute('GET', '/', function (){
//                $content = '<h1>Hello World web</h1>';
//                return new Response( $content);
//            });
//            $routeCollector->addRoute('GET', '/post/{id:\d+}', function ($routeParams){
//                $content = "<h1>This is post {$routeParams['id']}</h1>";
//                return new Response( $content);
//            });
        });

       $routeInfo = $dispatcher->dispatch(
           $request->getMethod(),
           $request->getPathInfo()
       );
       [$status,[$controller, $method], $vars] = $routeInfo;
        return (new $controller())->$method(...$vars);
    }
}