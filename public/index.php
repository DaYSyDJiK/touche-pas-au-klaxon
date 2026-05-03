<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

// Analyse de l'URL
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$basePath = rtrim($scriptName, '/');

// Nettoyage du chemin
$path = trim(str_replace($basePath, '', $requestUri), '/');
$segments = explode('/', $path);
if ($segments[0] === 'index.php') {
    array_shift($segments);
}

// ✅ Contrôleur et action par défaut
$controllerName = !empty($segments[0]) ? $segments[0] : 'trajets';
$action = $segments[1] ?? 'index';

$controllerClass = 'App\\Controllers\\' . ucfirst($controllerName) . 'Controller';

if (!class_exists($controllerClass)) {
    http_response_code(404);
    echo "Contrôleur '$controllerClass' non trouvé.";
    exit;
}

$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo "Action '$action' non trouvée.";
    exit;
}

$controller->$action();
