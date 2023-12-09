<?php

namespace App\Controller;
use MartinNyagah\framework\src\Http\Response;

class HomeController
{
    public static function index(): Response
    {
        $content = '<h1>Hello World</h1>';
        return  new Response($content);
    }
}