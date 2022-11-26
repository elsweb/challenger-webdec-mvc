<?php
namespace Controllers;

class Home
{
    public function __construct($router)
    {
        $auth = new \Controllers\Auth();
        if($auth->getSession() !== 'VALID'):
            header("Location: ".APP['BASE_URL'] ?? 'localhost'."/login");
        endif;
    }
    public function index($data)
    {
        $auth = new Auth();

        echo "Home here {$auth->getSession()}";
    }
}