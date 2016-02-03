<?php
namespace Models\Queries;
use Helpers\DB\Query;

class UtilisateurSQL extends Query{
    public function prepareFindByLogin($login) {
        $tmp = parent::__call("prepareFindByLogin",array($login))->execute();
        if(count($tmp)==0)
            return false;
        return $tmp[0];
    }
}
