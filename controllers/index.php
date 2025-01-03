<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'autoload.php';
// require 'models/connexionPDO.php';

class Router
{
    private $routes = [];
    private $prefix;

    public function __construct($prefix = '')
    {
        $this->prefix = trim($prefix, '/');
    }

    public function addRoute($uri, $controllerMethod)
    {
        $this->routes[trim($uri, '/')] = $controllerMethod;
    }

    public function generateUrl($route, $params = [])
    {
        foreach ($params as $key => $value) {
            $route = str_replace("{" . $key . "}", $value, $route);
        }
        return '/' . trim($this->prefix . '/' . $route, '/');
    }
    

    public function route($url)
    {
        // Enlève le préfixe du début de l'URL
        if ($this->prefix && strpos($url, $this->prefix) === 0) {
            $url = substr($url, strlen($this->prefix) + 1);
        }

        // Enlève les barres obliques en trop
        $url = trim($url, '/');

        // Vérification de la correspondance de l'URL à une route définie
        foreach ($this->routes as $route => $controllerMethod) {
            // Vérifie si l'URL correspond à une route avec des paramètres
            $routeParts = explode('/', $route);
            $urlParts = explode('/', $url);

            // Si le nombre de segments correspond
            if (count($routeParts) === count($urlParts)) {
                // Vérification de chaque segment
                $params = [];
                $isMatch = true;
                foreach ($routeParts as $index => $part) {
                    if (preg_match('/^{\w+}$/', $part)) {
                        // Capture les paramètres
                        $params[] = $urlParts[$index];
                    } elseif ($part !== $urlParts[$index]) {
                        $isMatch = false;
                        break;
                    }
                }

                if ($isMatch) {
                    // Extraction du nom du contrôleur et de la méthode
                    list($controllerName, $methodName) = explode('@', $controllerMethod);

                    // Instanciation du contrôleur et appel de la méthode avec les paramètres
                    $controller = new $controllerName();
                    call_user_func_array([$controller, $methodName], $params);
                    return;
                }
            }
        }

        // Si aucune route n'a été trouvée, gérer l'erreur 404
        require_once 'views/404.php';
    }
}

// Instanciation du routeur
$router = new Router('DungeonXplorer');

// Ajout des routes
//$router->addRoute('', 'HomeController@index'); // Pour la racine
$router->addRoute('Chapter/{id}', 'ChapterController@show'); // Pour la liste des tâches
// $router->addRoute('tasks/{id}', 'TaskController@show'); // Pour afficher une tâche par ID
// $router->addRoute('about', 'AboutController@index'); // Pour la page "about"
$router->addRoute('addToInventory', 'ChapterController@addToInventory');

// Appel de la méthode route
$router->route('Chapter/1');

$GLOBALS['router'] = $router;

$requestedUrl = str_replace('/DungeonXplorer/', '', $_SERVER['REQUEST_URI']);
$router->route(trim($requestedUrl, '/'));



?>
