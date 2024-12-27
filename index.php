<?php

define('ROOT', __DIR__);

    // Include the Router class
    // @note: it's recommended to just use the composer autoloader when working with other packages too
    require_once __DIR__ . '/Router/Router.php';
    require_once __DIR__ . '/controllers/ChapterController.php';

    // Create a Router
    $router = new \Bramus\Router\Router();

    // Custom 404 Handler
    $router->set404(function () {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        echo '404, route not found!';
    });

    // custom 404
    $router->set404('/test(/.*)?', function () {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        echo '<h1><mark>404, route not found!</mark></h1>';
    });

    $router->set404('/api(/.*)?', function() {
        header('HTTP/1.1 404 Not Found');
        header('Content-Type: application/json');

        $jsonArray = array();
        $jsonArray['status'] = "404";
        $jsonArray['status_text'] = "route not defined";

        echo json_encode($jsonArray);
    });

    // Before Router Middleware
    $router->before('GET', '/.*', function () {
        header('X-Powered-By: bramus/router');
    });

    // Static route: / (homepage)
    $router->get('/Chapter/(\d+)', 'ChapterController@show');
    $router->get('/views/combat_view', function() {
        echo "la";
    });

    // Static route: /hello
    $router->get('/hello', function () {
        echo '<h1>bramus/router</h1><p>Visit <code>/hello/<em>name</em></code> to get your Hello World mojo on!</p>';
    });

    // Dynamic route: /hello/name
    $router->get('/hello/(\w+)', function ($name) {
        echo 'Hello ' . htmlentities($name);
    });

    $router->get('/',function() {
        header('Location: /DungeonXplorer/views/accueil.php');
    });

     // Thunderbirds are go!
     $router->run();

?>