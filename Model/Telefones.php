<?php
namespace Model;

use SimpleCrud\Table;

class Telefones extends Table
{




    public function selectLatest()
    {
        return $this->select()->orderBy('id DESC')->limit(10);
    }
}