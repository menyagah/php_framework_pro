<?php

namespace MartinNyagah\Framework\Http;


use MartinNyagah\Framework\Routing\Router;
use MartinNyagah\Framework\Routing\RouterInterface;
use Psr\Container\ContainerInterface;


class Kernel
{
    private string $appEnv;
    public function __construct(
        private RouterInterface $router,
        private ContainerInterface $container,
    )
    {
        $this->appEnv = $this->container->get('APP_ENV');
    }

    public function handle(Request $request): Response
    {

        try {

            [$routeHandler, $vars] = $this->router->dispatch($request, $this->container);
            $response = call_user_func_array($routeHandler, $vars);

        } catch (\Exception $exception){
            $response = $this->createExceptionResponse($exception);
        }
        return $response;
    }

    private  function createExceptionResponse(\Exception $exception): Response
    {
        if (in_array($this->appEnv, ['dev', 'test'])){
            throw $exception;
        }
        if($exception instanceof HttpException) {
            return new Response($exception->getMessage(), $exception->getStatusCode());
        }

        return new Response('server error', Response::HTTP_INTERNAL_SERVER_ERROR);

    }
}