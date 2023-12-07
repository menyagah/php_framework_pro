<?php declare(strict_types=1);

use MartinNyagah\Framework\Http\Kernel;
use MartinNyagah\Framework\Http\Request;
use MartinNyagah\Framework\Http\Response;

require_once dirname(__DIR__) . '/vendor/autoload.php';
// request received
$request = Request::createFromGlobals();

// perform some logic


// send response (string of content)
//$content = '<h1>Hello World web</h1>';
//$response = new Response(content: $content, status:  200, headers: []);

$kernel = new Kernel();
$response = $kernel->handle($request);

$response->send();

