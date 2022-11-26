<?php
namespace Model;

use SimpleCrud\Table;

class Pessoas extends Table
{




    public function selectLatest()
    {
        return $this->select()->orderBy('id DESC')->limit(10);
    }
}