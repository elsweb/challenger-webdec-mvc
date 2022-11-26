<?php
namespace Controllers;

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
        echo "Home here";
    }
}