<?php

namespace MartinNyagah\Framework\Routing;

use MartinNyagah\Framework\Http\Request;

interface RouterInterface
{
    public static function dispatch(Request $request);
}