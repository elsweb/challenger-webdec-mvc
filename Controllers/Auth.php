<?php
namespace Controllers;
use Jenssegers\Blade\Blade;

class Auth
{
    public function index(){
        $blade = new Blade('views', 'cache');
        echo $blade->make('auth.index', [
            'base' => 'https://local.elsweb.com.br/challenger-webdec-mvc',
        ])->render();
    }
}