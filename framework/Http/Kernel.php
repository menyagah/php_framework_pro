<?php

namespace MartinNyagah\Framework\Http;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Kernel
{
    public function handle(Request $request): Response
    {

        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector){
            $routeCollector->addRoute('GET', '/', function (){
                $content = '<h1>Hello World web</h1>';
                return new Response( $content);
            });
            $routeCollector->addRoute('GET', '/post/{id:\d+}', function ($routeParams){
                $content = "<h1>This is post {$routeParams['id']}</h1>";
                return new Response( $content);
            });
        });

       $routeInfo = $dispatcher->dispatch(
           $request->getMethod(),
           $request->getPathInfo()
       );
       [$status, $handler, $vars] = $routeInfo;
       return $handler($vars);
    }
}