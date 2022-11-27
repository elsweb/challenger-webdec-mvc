<?php
require_once __DIR__ . '/vendor/autoload.php';

use CoffeeCode\Router\Router;
use Analog\Analog;
use Analog\Handler\File;

$router = new Router(APP['BASE_URL'] ?? 'localhost');
$router->group(null)->namespace("Controllers");

$router->get("/", "Home:index");
$router->get("/login", "Auth:index");
$router->post("/login", "Auth:login");
$router->post("/register", "Auth:register");
$router->get("/logout", "Auth:logout");

/*module people*/
$router->get("/pessoas", "Pessoas:index");
$router->post("/pessoas", "Pessoas:listar");
$router->post("/pessoas/create", "Pessoas:create");
$router->delete("/pessoas/delete/{id}", "Pessoas:delete");
$router->get("/pessoas/view/{id}", "Pessoas:view");
/*later to convert to method "PUT", i tried but the not to accepted.*/
$router->post("/pessoas/update", "Pessoas:update");

/*module phone*/
$router->post("/telefones/create", "Telefones:create");
$router->delete("/telefones/delete/{id}", "Telefones:delete");

$router->group("error");
$router->get("/{errcode}", function ($request) {
    $request = json_encode($request);
    Analog::handler (File::init ('log.txt'));
    Analog::log($request , Analog::ALERT);
    $url = (APP['BASE_URL'] ?? 'localhost') . (APP['HOME_REDIRECT'] ?? '');
    header("Location: {$url}");
});

$router->dispatch();

/*
 * Redirect all errors
 */
if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}