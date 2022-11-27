<?php
namespace Controllers;

class Validator
{
    public function uf($uf)
    {
        $siglas = [
            'AC',
            'AL',
            'AP',
            'AM',
            'BA',
            'CE',
            'DF',
            'ES',
            'GO',
            'MA',
            'MS',
            'MT',
            'MG',
            'PA',
            'PB',
            'PR',
            'PE',
            'PI',
            'RJ',
            'RN',
            'RS',
            'RO',
            'RR',
            'SC',
            'SP',
            'SE',
            'TO',
        ];
        return in_array($uf, $siglas);
    }
    public function onlyNumbers($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }
    public function existsCpf($pdo, $table,$typedoc, $doc)
    {
        $db = new \SimpleCrud\Database($pdo);
        $db->setTablesClasses([
            $table => \Model\Pessoas::class,
        ]);
        $check = $db->$table->select()->whereEquals([$typedoc => $doc,])->one()->get();
        
        return $check;
    }
    public function validaCpf($cpf)
    {
        //author: https://gist.github.com/rafael-neri
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;

    }
}