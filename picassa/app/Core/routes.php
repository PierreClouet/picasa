<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @version 2.2
 * @date updated Sept 19, 2015
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;


/** Define routes. */
Router::any('', 'Controllers\Welcome@index');

Router::any('/film/(:num)','Controllers\Welcome@film');
Router::any('/insererpersonne','Controllers\Welcome@insererPersonne');
Router::any('/test','Controllers\Welcome@test');

/** Utilisateurs */

Router::any('/utilisateur/inscription','Controllers\User@register');
Router::any('/utilisateur/login','Controllers\User@login');
Router::any('/utilisateur/logout','Controllers\User@logout');

/** Photos */

Router::any('/ajouter','Controllers\Welcome@ajouter');
Router::any('/supprimer/(:num)','Controllers\Welcome@supprimer');
Router::any('/ajouter/album','Controllers\Welcome@ajoutalbum');
Router::any('/lier/(:num)/(:num)','Controllers\Welcome@lier');

/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');

/** If no route found. */
Router::error('Core\Error@index');

/** Turn on old style routing. */
Router::$fallback = false;

/** Execute matched routes. */
Router::dispatch();
