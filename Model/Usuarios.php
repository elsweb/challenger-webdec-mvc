<?php
namespace Model;

use SimpleCrud\Table;

class Usuarios extends Table
{




    public function selectLatest()
    {
        return $this->select()->orderBy('id DESC')->limit(10);
    }
}