<?php
namespace Controllers;
use Jenssegers\Blade\Blade;

class Home
{
    public function __construct($router)
    {
        $auth = new \Controllers\Auth();
        if($auth->getSession() !== 'VALID'):
            $url = (APP['BASE_URL'] ?? 'localhost')."/login" ;
            header("Location: {$url}");
        endif;
    }
    public function index($data)
    {
        $csrf = new \Controllers\CsrfProtect();
        $blade = new Blade('views', 'cache');
        echo $blade->make('index', [
            'csrf' => $csrf->csrf()
        ])->render();
    }
}