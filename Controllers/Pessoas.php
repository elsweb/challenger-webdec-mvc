<?php
namespace Controllers;

use Jenssegers\Blade\Blade;
use Josantonius\Request\Request;

class Pessoas
{
    public function __construct()
    {
        $auth = new \Controllers\Auth();
        if ($auth->getSession() !== 'VALID'):
            $url = (APP['BASE_URL'] ?? 'localhost') . "/login";
            header("Location: {$url}");
        endif;
    }
    public function index()
    {
        $csrf = new \Controllers\CsrfProtect();
        $blade = new Blade('views', 'cache');
        echo $blade->make('people.index', [
            'csrf' => $csrf->csrf()
        ])->render();
    }
    public function listar()
    {
        header('Content-Type: application/json; charset=utf-8');
        try {
            $pdo = new \PDO("mysql:host=" . APP['DB_HOST'] . ";port=" . APP['DB_PORT'] . ";dbname=" . APP['DB_DATABASE'] . ";charset=utf8mb4", APP['DB_USERNAME'], APP['DB_PASSWORD']);
            $db = new \SimpleCrud\Database($pdo);
            $db->setTablesClasses([
                'pessoas' => \Model\Pessoas::class,
            ]);
            // $pessoas = $db->pessoas->select('id')->get();

            $query = $db->pessoas->select()
                ->whereEquals([
                    'data_exclusao' => null,
                ])
                ->page(1)
                ->perPage(50);
            $pessoas = $query->get();

            $columns = [
                ["title" => '#'],
                ["title" => 'Nome'],
                ["title" => 'CPF'],
                ["title" => 'RG'],
                ["title" => 'Endereço'],
                ["title" => 'CEP'],
                ["title" => 'Telefones'],
                ["title" => ''],
            ];

            foreach ($pessoas as $value) {
                $num = [
                    "<a href='javascript:addphone(\"{$value->id}\");'><i class='fas fa-plus-circle' style='font-size: 1.3rem;'></i></a>"
                ];
                $end = $value->enderecos()->get();
                $est = $end->estados()->get();
                foreach ($value->telefones()->get() as $n) {
                    $num[] = $n->telefone;
                }

                $datatable[] = [
                    $value->id,
                    $value->nome,
                    $value->cpf,
                    $value->rg,
                    "{$est->uf} {$end->endereco} n° {$end->numero}",
                    $end->cep,
                    $num,
                    [
                        "<a href='javascript:edit(\"{$value->id}\");'><i class='far fa-edit' style='font-size: 1.3rem;'></i></a>",
                        "<a href='javascript:;' class='delete'><i class='far fa-trash-alt' style='font-size: 1.3rem;'></i></a>"
                    ]
                ];
            }

            //To get the page info:
            $pagination = $query->getPageInfo();
            echo json_encode([
                "status" => true,
                "data" => $datatable ?? [],
                "columns" => $columns,
                'pagination' => $pagination
            ]);
        } catch (\PDOException $ex) {
            echo json_encode([
                "status" => false,
                "msg" => "Falha ao conectar",
            ]);
            return false;
        }
    }
    public function create()
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
                    'pessoas' => \Model\Pessoas::class,
                ]);
                /*create estados*/
                $estado = $db->estados->create([
                    'uf' => $request['uf'] ?? null,
                ]);
                $estado->save();
                /*create enderecos*/
                $enderecos = $db->enderecos->create([
                    'estados_id' => $estado->id,
                    'cep' => $request['cep'] ?? null,
                    'endereco' => $request['endereco'] ?? null,
                    'numero' => $request['numero'] ?? null,
                ]);
                $enderecos->save();

                /*create pessoas*/
                $pessoas = $db->pessoas->create([
                    'nome' => $request['nome'] ?? null,
                    'cpf' => $request['cpf'] ?? null,
                    'rg' => $request['rg'] ?? null,
                    'enderecos_id' => $enderecos->id,
                    // 'data_nascimento' => '2022-11-15', //fix this
                    // 'data_cadastro' => '2022-11-22 00:00:00', //fix this
                    // 'data_atualizacao' => '2022-11-22 00:00:00', //fix this
                    // 'data_exclusao' => '2022-11-22 00:00:00', //fix this

                ]);
                $pessoas->save();

                echo json_encode([
                    'status' => true,
                    'msg' => "Obrigado por se cadastrar, agora pode acessar",
                    'row' => [
                        $pessoas->id,
                        $pessoas->nome,
                        $pessoas->cpf,
                        $pessoas->rg,
                        "{$pessoas->enderecos()->get()->estados()->get()->uf} {$pessoas->enderecos()->get()->endereco} n° {$pessoas->enderecos()->get()->numero}",
                        $pessoas->enderecos()->get()->cep,
                        [
                            "<a href='javascript:addphone(\"{$pessoas->id}\");'><i class='fas fa-plus-circle' style='font-size: 1.3rem;'></i></a>"
                        ],
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
                    'pessoas' => \Model\Pessoas::class,
                ]);
                $pessoas = $db->pessoas->select()
                    ->whereEquals([
                        'id' => $id,
                    ])->one()->get();
                $pessoas->data_exclusao = date('Y-m-d H:i:s');
                $pessoas->save();
                echo json_encode([
                    'status' => true,
                    'token' => $csrf->csrf()
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