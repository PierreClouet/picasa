<?php
use Helpers\Session;
use Helpers\HTML;

//print_r($_SESSION);
?>
<div class="container-fluid">

<?php
echo"<div class='imgs col-md-3 shadow'>";
foreach($data['photo'] as $p) {
    echo"<div class='imgseparate col-md-6' data-id='".$p->getId()."'>
            <div class='avatar'>";
    echo HTML::img(DIR.$p->fichier,'rien');
    echo "</div>
        <div class='nom-photo'>
            $p->nom";
    if(Session::get('id')==$p->utilisateur_id)
        echo HTML::lien(DIR . "supprimer/" . $p->getId(), " - X");
        echo "</div>
    </div>";

}
echo"</div>";
?>

<?php
echo "<div class='col-md-9'>";
if($data['albums'] != false){
    foreach($data['albums'] as $a){
       echo"<div class='drag-zone shadow' data-id='".$a->getId()."'>";
       echo "<h2 class='album-title'>$a->nom</h2>";
       echo"</div>";
    }
}
echo "</div>"
?>

</div>





