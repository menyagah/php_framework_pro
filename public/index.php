<?php declare(strict_types=1);

use MartinNyagah\Framework\Http\Kernel;
use MartinNyagah\Framework\Http\Request;
use MartinNyagah\Framework\Http\Response;

define('BASE_PATH', dirname(__DIR__));

require_once dirname(__DIR__) . '/vendor/autoload.php';
// request received
$request = Request::createFromGlobals();
$router = new \MartinNyagah\Framework\Routing\Router();
// perform some logic
$kernel = new Kernel($router);
// send response (string of content)
$response = $kernel->handle($request);

$response->send();

