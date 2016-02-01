<?php

namespace Models\Tables;
use Helpers\DB\Entity;

class Utilisateur extends Entity {
    public $login;
    public $email;
    public $password;
    public $cookie;

    /**
     * Utilisateur constructor.
     * @param $login
     * @param $email
     * @param $password
     */
    public function __construct($login = "", $email = "", $password = "", $cookie = "", $id = false) {
        parent::__construct();
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->cookie = $cookie;
        $this->id = $id;
    }
}