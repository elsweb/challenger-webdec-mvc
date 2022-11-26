<?php
namespace Controllers;

use Jenssegers\Blade\Blade;
use Josantonius\Request\Request;

ini_set('session.gc_maxlifetime', 86400);
session_start();
class Auth
{
    public function index($router)
    {
        if (self::getSession() === 'VALID'):
            header("Location: ".APP['BASE_URL'] ?? 'localhost'."");
        endif;
        $blade = new Blade('views', 'cache');
        echo $blade->make('auth.index', [])->render();
    }
    public function login()
    {
        header('Content-Type: application/json; charset=utf-8');
        $request = Request::input('POST')()->asArray();
        try {
            $pdo = new \PDO("mysql:host=" . APP['DB_HOST'] . ";port=" . APP['DB_PORT'] . ";dbname=" . APP['DB_DATABASE'] . ";charset=utf8mb4", APP['DB_USERNAME'], APP['DB_PASSWORD']);
        } catch (\PDOException $ex) {
            echo json_encode([
                "status" => false,
                "msg" => "Falha ao conectar",
            ]);
            return false;
        }
        $auth_factory = new \Aura\Auth\AuthFactory($_SESSION);
        $auth = $auth_factory->newInstance();
        $hash = new \Aura\Auth\Verifier\PasswordVerifier(PASSWORD_BCRYPT);
        $cols = array('username', 'email', 'password');
        $from = 'usuarios';
        $pdo_adapter = $auth_factory->newPdoAdapter($pdo, $hash, $cols, $from);
        $login_service = $auth_factory->newLoginService($pdo_adapter);
        try {
            $login_service->login(
                $auth,
                array(
                    'username' => $request['username'] ?? '',
                    'password' => $request['password'] ?? ''
                )
            );
            echo json_encode([
                'status' => true,
                'msg' => "Bem-vindo aguarde o redirecionamento"
            ]);
            return true;
        } catch (\Throwable $th) {
            echo json_encode([
                'status' => false,
                'msg' => "Usuário ou senha inválidos"
            ]);
            return false;
        }
    }
    public function getSession()
    {
        $auth_factory = new \Aura\Auth\AuthFactory($_SESSION);
        $auth = $auth_factory->newInstance();
        $resume_service = $auth_factory->newResumeService();
        $resume_service->resume($auth);
        if ($auth->getStatus() !== 'VALID'):
            $logout_service = $auth_factory->newLogoutService();
            $logout_service->forceLogout($auth);
        endif;
        return $auth->getStatus();
    }
}