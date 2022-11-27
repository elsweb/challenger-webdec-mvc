<?php
namespace Controllers;

use Josantonius\Request\Request;
use \Controllers\Validator;

class Telefones
{
    public function __construct()
    {
        $auth = new \Controllers\Auth();
        if ($auth->getSession() !== 'VALID'):
            $url = (APP['BASE_URL'] ?? 'localhost') . "/login";
            header("Location: {$url}");
        endif;
    }
    public function create()
    {
        /*for force queue order ajax*/
        sleep(1);
        header('Content-Type: application/json; charset=utf-8');
        $csrf = new \Controllers\CsrfProtect();
        if ($csrf->check($_SERVER['HTTP_X_CSRF_TOKEN'])):
            $request = Request::input('POST')()->asArray();
            $check = new Validator();
            $request['telefone'] = $check->onlyNumbers($request['telefone']);
            try {
                $pdo = new \PDO("mysql:host=" . APP['DB_HOST'] . ";port=" . APP['DB_PORT'] . ";dbname=" . APP['DB_DATABASE'] . ";charset=utf8mb4", APP['DB_USERNAME'], APP['DB_PASSWORD']);
                $existsPhone = $check->existsPhone($pdo, $request['telefone'] ?? null);
                if(!is_null($existsPhone) && is_null($existsPhone->pessoas()->get()->data_exclusao)):
                    echo json_encode([
                        'status' => false,
                        'msg' => "Telefone já cadastrado",
                        'token' => $csrf->csrf(), 
                    ]);
                    return false;
                endif; 
                $db = new \SimpleCrud\Database($pdo);
                $db->setTablesClasses([
                    'pessoas' => \Model\Pessoas::class,
                    'telefones' => \Model\Telefones::class,
                ]);

                /*create pessoas*/
                $telefones = $db->telefones->create([
                    'pessoas_id' => $request['id'] ?? null,
                    'telefone' => $request['telefone'] ?? null,
                ]);
                $telefones->save();

                $pessoas = $db->pessoas->select()
                    ->whereEquals([
                        'id' => $request['id'] ?? null,
                    ])->one()->get();
                
                $num = [
                    "<a href='javascript:;' class='addphone'><i class='fas fa-plus-circle' style='font-size: 1.3rem;'></i></a>"
                ];                
                foreach ($pessoas->telefones()->get() as $n) {
                    $num[] = "<a href='javascript:;' id='phone_{$n->id}' class='removephone btn-sm btn-danger'>{$n->telefone}</a>";
                }

                echo json_encode([
                    'status' => true,
                    'row' => [
                        $pessoas->id,
                        $pessoas->nome,
                        $pessoas->cpf,
                        $pessoas->rg,
                        "{$pessoas->enderecos()->get()->estados()->get()->uf} {$pessoas->enderecos()->get()->endereco} n° {$pessoas->enderecos()->get()->numero}",
                        $pessoas->enderecos()->get()->cep,
                        $num,
                        [
                            "<a href='javascript:edit(\"{$pessoas->id}\");'><i class='far fa-edit' style='font-size: 1.3rem;'></i></a>",
                            "<a href='javascript:;' class='delete'><i class='far fa-trash-alt' style='font-size: 1.3rem;'></i></a>"
                        ]
                    ],
                    'token' => $csrf->csrf(), // reload token for user login
                ]);
                return true;
            } catch (\PDOException $ex) {
                echo json_encode([
                    "status" => false,
                    "msg" => "Falha ao conectar",
                    'error' => $ex,
                    'token' => $csrf->csrf(), // reload token 

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
    public function delete($id)
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
                    'telefones' => \Model\Telefones::class,
                ]);
                $telefones = $db->telefones->select()
                    ->whereEquals([
                        'id' => $id,
                    ])->one()->get();

                $pessoas = $db->pessoas->select()
                ->whereEquals([
                    'id' => $telefones->pessoas_id
                ])->one()->get();                
                $telefones->delete();

                $num = [
                    "<a href='javascript:;' class='addphone'><i class='fas fa-plus-circle' style='font-size: 1.3rem;'></i></a>"
                ];                
                foreach ($pessoas->telefones()->get() as $n) {
                    $num[] = "<a href='javascript:;' id='phone_{$n->id}' class='removephone btn-sm btn-danger'>{$n->telefone}</a>";
                }

                echo json_encode([
                    'status' => true,
                    'row' => [
                        $pessoas->id,
                        $pessoas->nome,
                        $pessoas->cpf,
                        $pessoas->rg,
                        "{$pessoas->enderecos()->get()->estados()->get()->uf} {$pessoas->enderecos()->get()->endereco} n° {$pessoas->enderecos()->get()->numero}",
                        $pessoas->enderecos()->get()->cep,
                        $num,
                        [
                            "<a href='javascript:edit(\"{$pessoas->id}\");'><i class='far fa-edit' style='font-size: 1.3rem;'></i></a>",
                            "<a href='javascript:;' class='delete'><i class='far fa-trash-alt' style='font-size: 1.3rem;'></i></a>"
                        ]
                    ],
                    'token' => $csrf->csrf(), // reload token for user login
                ]);
                return true;
            } catch (\PDOException $ex) {
                echo json_encode([
                    "status" => false,
                    "msg" => "Falha ao conectar",
                    'error' => $ex,
                    'token' => $csrf->csrf(),
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
}