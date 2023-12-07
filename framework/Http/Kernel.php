<?php

namespace MartinNyagah\Framework\Http;

class Kernel
{
    public function handle(Request $request): Response
    {
        $content = '<h1>Hello World web</h1>';
        return new Response(content: $content, status:  200, headers: []);
    }
}