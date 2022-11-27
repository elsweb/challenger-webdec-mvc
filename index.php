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

/*module people*/
$router->get("/pessoas", "Pessoas:index");
$router->post("/pessoas", "Pessoas:listar");
$router->post("/pessoas/create", "Pessoas:create");
$router->delete("/pessoas/delete/{id}", "Pessoas:delete");
$router->get("/pessoas/view/{id}", "Pessoas:view");
/*later to convert to method "PUT", i tried but the not to accepted.*/
$router->post("/pessoas/update", "Pessoas:update");


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