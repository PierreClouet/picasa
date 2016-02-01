<?php
namespace Models\Tables;
use Helpers\DB\Entity;


class Contient extends Entity {
    public $album_id;
    public $photo_id;
    
    public function __construct($a="",$c="",$id=false) {
        parent::__construct();
        $this->album_id = $a;
        $this->photo_id = $c;
    }
    

}