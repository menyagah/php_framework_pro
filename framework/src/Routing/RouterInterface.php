<?php

namespace MartinNyagah\Framework\Routing;

use MartinNyagah\Framework\Http\Request;

interface RouterInterface
{
    public function dispatch(Request $request);
}