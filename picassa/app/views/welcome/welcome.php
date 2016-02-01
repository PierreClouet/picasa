<?php
use Helpers\Session;
use Helpers\HTML;

//print_r($_SESSION);
?>
<div class="container">
    <h1><?php echo "Bonjour " .Session::get('login'); ?></h1>
    <hr>
</div>



<?php
if($data['albums'] != false){
    foreach($data['albums'] as $a){
        echo "$a->nom<br/>";
    }
}
?>

<?php

foreach($data['photo'] as $p) {
    echo"<div class='imgseparate'>
			<div class='avatar'>";
    echo HTML::img(DIR.$p->fichier,'rien');
    echo "</div>
		<div class='name'>
			$p->nom";
    if(Session::get('id')==$p->utilisateur_id)
        echo HTML::lien(DIR . "supprimer/" . $p->getId(), "X");
        echo "</div>
    </div>";

}

?>

