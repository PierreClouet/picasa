<?php

namespace Models\Tables;
use Helpers\DB\Entity;

class Album extends Entity {
    public $nom;
    public $utilisateur_id;
    
    public function __construct($n="",$u="",$id=false) {
        parent::__construct();
        $this->nom = $n;
        $this->utilisateur_id=$u;
        $this->id = $id;
    }
    

    public function addPhoto($idphoto) {
        if($this->id==false) return;
        $c = new Contient($this->id,$idphoto);
        $c->save();
    }
}