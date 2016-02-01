<?php
namespace Models\Tables;
use Helpers\DB\Entity;

class Photo extends Entity {
    public $nom;
    public $fichier;
    public $post_date;
    public $style;
    public $utilisateur_id;
    private $user;
    
    public function __construct($n="",$f="",$p="",$s="",$u="",$id=false) {
        parent::__construct();
        $this->nom = $n;
        $this->fichier = $f;
        $this->post_date = $p;
        $this->style = $s;
        $this->utilisateur_id = $u;
        $this->user = false;
    }
    
    
    public function getUtilisateur() {
        if($this->user==false || $this->utilisateur_id != $this->user->getId()) {
            $sql = new UtilisateurSQL();
            $this->user = $sql->findById($this->utilisateur_id);
        }
        return $this->user;
    }
    

}