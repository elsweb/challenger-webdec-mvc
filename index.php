<?php
require_once __DIR__ . '/vendor/autoload.php';

use CoffeeCode\Router\Router;
use Analog\Analog;
use Analog\Handler\File;

$router = new Router(APP['BASE_URL']);
$router->group(null)->namespace("Controllers");

$router->get("/", "Home:index");
$router->get("/login", "Auth:index");
$router->post("/login", "Auth:login");
$router->post("/register", "Auth:register");


$router->post("/json",function(){
    header('Content-type: application/json');
    echo json_encode([
        'status' => true
    ]);
});

$router->group("error");
$router->get("/{errcode}", function ($request) {
    /*
    Posteriormente é preciso estudar a documentação da lib para
    pegar a rota que foi chamada para incluir no log.
    */
    var_dump(BASE_URL);
    $request = json_encode($request);
    Analog::handler (File::init ('log.txt'));
    Analog::log($request , Analog::ALERT);
});

$router->dispatch();

/*
 * Redirect all errors
 */
if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}