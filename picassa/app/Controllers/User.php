<?php
/**
 * Created by PhpStorm.
 * User: audemard
 * Date: 23/10/2015
 * Time: 15:43
 */

namespace Controllers;

use Core\Controller;
use \Core\View,
    \Helpers\Session,
    \Helpers\Password,
    \Helpers\Url,
    \Helpers\Gump, Models\Queries\UtilisateurSQL;
use Models\Tables\Utilisateur;


class User extends Controller {

    private $userSQL;

    public function __construct() {
        parent::__construct();
        $this->userSQL = new UtilisateurSQL();
    }

    public function login() {
        //Sanitize Data using Gump helper
        $_POST = Gump::sanitize($_POST);

        if (isset($_POST['login'])) {
            //Validate data using Gump
            $is_valid = Gump::is_valid($_POST, array(
                'login' => 'required',
                'password' => 'required' //|max_len,18|min_len,6
            ));

            // If input is valid then check for username and password matching
            if ($is_valid === true) {
                $user = $this->userSQL->prepareFindByLogin($_POST['login']);

                if ($user == false || Password::verify($_POST['password'], $user->password) == false)
                    $error[] = 'Mauvaises données';
            } else {
                // $is_valid holds an array for the errors.
                $error = $is_valid;
            }
            if (!$error) {

                Session::set('loggedin', true);
                Session::set('id', $user->getId());
                Session::set('login', $user->login);
                if (isset($_POST['remember'])) {
                    $user->cookie = $this->randomkey(64);
                    $this->entityManager->save($user);
                    setcookie("remember", $user->cookie, time() + 3600 * 31 * 24,DIR);
                }
                Session::set('message', "Bienvenu $user->login");
                Session::set('message_type', 'alert-success');
                Url::redirect();
                exit();
            }
        }

        $data['title'] = 'Login';

        View::rendertemplate('header', $data);
        View::render('user/login', $data, $error);
        View::rendertemplate('footer', $data);
    }

    public function logout() {

        Session::destroy('loggedin');
        Session::destroy('id');
        Session::destroy('login');
        setcookie("remember","",time()-10000,DIR);
        Session::set('message', 'Vous avez bien été déconnecté');
        Session::set('message_type', 'alert-success');
        Url::redirect();
    }

    public function change_password() {

        //Sanitize Data using Gump helper
        $_POST = Gump::sanitize($_POST);

        if (isset($_POST['password'])) {

            //Validate data using Gump
            $is_valid = Gump::is_valid($_POST, array(
                'current_password' => 'required', //|max_len,18|min_len,6
                'password' => 'required', //|max_len,18|min_len,6
                'password-again' => 'required' //|max_len,18|min_len,6
            ));

            if ($is_valid === true) {
                $user = $this->userSQL->find(Session::get('id'));

                if (Password::verify($_POST['current_password'], $user->password) === true) {
                    if ($_POST['password'] != $_POST['password-again']) {
                        $error[] = 'Les deux mots de passe ne sont pas identiques';
                    }
                } else {
                    $error[] = 'mot de passe courant incorrect';
                }
            } else {
                // $is_valid holds an array for the errors.
                $error = $is_valid;
            }
            if (!$error) {
                $user->password = Password::make($_POST['password']);
                $this->entityManager->save($user);
                Session::set('message', 'Votre mot de passe a bien été mis à jour');
                Url::redirect();

            }
        }

        $data['title'] = 'Change Password';
        View::rendertemplate('header', $data);
        View::render('user/modification', $data, $error);
        View::rendertemplate('footer', $data);

    }

    public function register() {


        //Sanitize Data using Gump helper
        $_POST = Gump::sanitize($_POST);
        if (isset($_POST['login'])) {
            //Validate data using Gump
            $is_valid = Gump::is_valid($_POST, array(
                'login' => 'required|alpha_numeric',
                'email' => 'required|valid_email',
                'password' => 'required', //|max_len,18|min_len,6
                'password-again' => 'required' //|max_len,18|min_len,6
            ));

            if ($is_valid === true) {
                //Test for duplicate username`
                $user = $this->userSQL->prepareFindByLogin($_POST['login']);

                if ($_POST['password'] != $_POST['password-again'])
                    $error[] = "Les deux mots de passes doivent être identiques";

                if ($user != false)
                    $error[] = 'Ce compte existe déjà';

                $user = $this->userSQL->prepareFindByEmail($_POST['email'])->execute();
                //Test for dupicate email address
                if (count($user) > 0)
                    $error[] = 'Ce compte email existe déjà.';

            } else
                $error = $is_valid;

            if (!$error) {
                //Register and return the data as an array $data[]
                $user = new Utilisateur($_POST['login'], $_POST['email'], Password::make($_POST['password']), "");
                $this->entityManager->save($user);
                Session::set('id', $user->getId());
                Session::set('login', $user->login);
                Session::set('loggedin', true);
                Url::redirect();
            }

        }
        $data['title'] = 'Inscription';
        View::rendertemplate('header', $data);
        View::render('user/register', $data, $error);
        View::rendertemplate('footer', $data);

    }

    private function randomkey($length = 10) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $key = "";
        for ($i = 0; $i < $length; $i++) {
            $key .= $chars{rand(0, strlen($chars) - 1)};
        }
        return $key;
    }

}