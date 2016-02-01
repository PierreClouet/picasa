<?php
/**
 * Sample layout
 */

use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;
use Helpers\HTML;
use Helpers\Session;

//initialise hooks
$hooks = Hooks::get();
?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<?php
	//hook for plugging in meta tags
	$hooks->run('meta');
	?>
	<title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/Core/Config.php ?></title>

	<!-- CSS -->
	<?php
	Assets::css(array(
		'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
		Url::templatePath() . 'css/style.css',
		Url::templatePath() . 'https://fonts.googleapis.com/css?family=Roboto',
		Url::templatePath() . 'css/style2.css',
	));

	//hook for plugging in css
	$hooks->run('css');
	?>

</head>
<body>
<?php
//hook for running code after body tag
$hooks->run('afterBody');
?>
<div class="nav navbar-fixed-top">
	<div class="container-fluid">
		<span class="title"><?php echo $data['title'] ?></span>
		<ul class="menu">
			<li><a href="#">Menu 1</a></li>
			<li><a href="#">Menu 2</a></li>
			<li><a href="#">Menu 3</a></li>
			<li><a href="#">Menu 4</a></li>

		</ul>
		<div class="btn">
			<?php
			if(Session::get('id')==null){
				echo HTML::lien(DIR."utilisateur/login","Connectez-vous");
				echo HTML::lien(DIR."utilisateur/inscription","Inscrivez-vous");
			}else{ //je suis connecte
				echo "<a href='#' id='photo_btn'>Ajouter photo</a>";
				echo "<a href='#' id='album_btn'>Ajouter album</a>";
				echo HTML::lien(DIR."utilisateur/logout","Deconnexion");
			}
			?>
		</div>

		<form class="search" action="#">
			<input class="search-bar" type="text" placeholder="Rechercher...">
			<input class="submit" type="submit" value="Go">
		</form>
	</div>
</div>
<div class="ajout-album">
	<?php if(Session::get('id')!=null){ ?>
		<form action="<?php echo DIR;?>ajouter/album" method="post">
			<input type="text" name="nom" placeholder="Nom..."><br />
			<input type="submit" value="Créer album">
		</form>
	<?php } ?>
</div>
<div class="ajout-photo">
	<form action="<?php echo DIR;?>ajouter" method="POST" enctype="multipart/form-data">
		<input type="text" name="nom" placeholder="Nom..."/><br />
		<input type="text" name="style" placeholder="Style..."/><br />
		<label>Fichier :</label><input type="file" name="fichier"/><br />
		<input type="submit" value="Ajouter" />
	</form>
</div>