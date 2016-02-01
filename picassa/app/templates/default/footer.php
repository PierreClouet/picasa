<?php
/**
 * Sample layout
 */

use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get();
?>


<!-- JS -->
<?php
Assets::js(array(
	Url::templatePath() . 'js/jquery.js',
	Url::templatePath() . 'js/script.js',
	Url::templatePath() . 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
));

//hook for plugging in javascript
$hooks->run('js');

//hook for plugging in code into the footer
$hooks->run('footer');
?>

</body>
</html>
