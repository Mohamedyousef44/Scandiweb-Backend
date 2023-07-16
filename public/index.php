
<?php

session_start();

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, DELETE');

const BASE_PATH = __DIR__.'/../';
require_once __DIR__.'/../vendor/autoload.php';

$router = new \Core\Router();
$routes = require BASE_PATH.'routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);


