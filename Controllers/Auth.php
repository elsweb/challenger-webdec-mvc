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
        $csrf = new \Controllers\CsrfProtect();
        if (self::getSession() === 'VALID'):
            $url = (APP['BASE_URL'] ?? 'localhost') . (APP['HOME_REDIRECT'] ?? '');
            header("Location: {$url}");
        endif;
        $blade = new Blade('views', 'cache');
        echo $blade->make('auth.index', [
            'csrf' => $csrf->csrf()
        ])->render();
    }
    public function login()
    {
        header('Content-Type: application/json; charset=utf-8');
        $csrf = new \Controllers\CsrfProtect();
        if ($csrf->check($_SERVER['HTTP_X_CSRF_TOKEN'])):
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
            $cols = array('username', 'password');
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
                    'msg' => "Usuário ou senha inválidos",
                    'token' => $csrf->csrf(), // reload token case not accept login

                ]);
                return false;
            }
        endif;
        echo json_encode([
            "status" => false,
            "msg" => "Ops algum erro aconteceu, csrf inválido tente recarregar a janela",
        ]);
        return false;
    }
    public function register()
    {
        /*for force queue order ajax*/
        sleep(1);
        header('Content-Type: application/json; charset=utf-8');
        $csrf = new \Controllers\CsrfProtect();
        if ($csrf->check($_SERVER['HTTP_X_CSRF_TOKEN'])):
            $request = Request::input('POST')()->asArray();
            try {
                $pdo = new \PDO("mysql:host=" . APP['DB_HOST'] . ";port=" . APP['DB_PORT'] . ";dbname=" . APP['DB_DATABASE'] . ";charset=utf8mb4", APP['DB_USERNAME'], APP['DB_PASSWORD']);
                $db = new \SimpleCrud\Database($pdo);
                $db->setTablesClasses([
                    'usuarios' => \Model\Usuarios::class,
                ]);
                $username = str_replace(' ', '', mb_strtolower($request['username']));
                /*check exists username*/
                $exists = $db->usuarios->select()->where('username = ', $username)->one()->get();
                if (is_null($exists->id ?? null)):
                    $new = $db->usuarios->create([
                        'username' => $username,
                        'password' => password_hash($request['password'], PASSWORD_BCRYPT),
                    ]);
                    $new->save();
                    echo json_encode([
                        'status' => true,
                        'msg' => "Obrigado por se cadastrar, agora pode acessar",
                        'token' => $csrf->csrf(), // reload token for user login

                    ]);
                    return true;
                endif;
                echo json_encode([
                    'status' => false,
                    'msg' => "Nome de usuário já utilizado",
                    'token' => $csrf->csrf(), // reload token for user login

                ]);
                return true;
            } catch (\PDOException $ex) {
                echo json_encode([
                    "status" => false,
                    "msg" => "Falha ao conectar",
                ]);
                return false;
            }
        endif;
        echo json_encode([
            "status" => false,
            "msg" => "Ops algum erro aconteceu, csrf inválido tente recarregar a janela",
        ]);
        return false;
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