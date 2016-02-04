<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@daveismyname.com
 * @version 2.2
 * @date June 27, 2014
 * @date updated Sept 19, 2015
 */

namespace Controllers;

use Core\View;
use Core\Controller;
use Helpers\DB\EntityManager;
use Helpers\Session;
use Models\Queries\FilmSQL;
use Models\Queries\AlbumSQL;
use Models\Queries\UtilisateurSQL;
use \Helpers\Url;
use \Helpers\GUMP;
use Models\Queries\PhotoSQL;
use Models\Tables\Photo;
use Models\Tables\Contient;
use Models\Tables\Album;
/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */

class Welcome extends Controller
{

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Define Index page title and load template files
     */
    public function index()
    {
        $data['title'] = "Picasa'zer";
        $data['welcome_message'] = "Bonjour";


        $sql = new PhotoSQL();
        $data['photo'] = $sql->prepareFindAll()
        ->orderBy("post_date DESC")
        ->limit(0,10)
        ->execute();

        if(Session::get('id')==null) {
            $data['albums'] = false;
        }else{
            $sqlA = new AlbumSQL();
            $data['albums'] = $sqlA->prepareFindByUtilisateur_id(Session::get('id'))
            ->orderBy("nom")->execute();
        }


        View::renderTemplate('header', $data);
        View::render('welcome/welcome', $data);
        View::renderTemplate('footer', $data);

    }

    public function ajouter()
    {
        if (Session::get('id') == null)
            Url::redirect();


        $data['title'] = "Ajouter";

        View::renderTemplate('header', $data);
        View::render('welcome/ajouter', $data);
        View::renderTemplate('footer', $data);

        if (isset($_POST['nom'])) {
            $error = false;
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['fichier']['name'], '.');
            if ($_FILES['fichier']['error'] != 0)
                $error = "Problème upload";
            if (!in_array($extension, $extensions))
                $error = 'Mauvaise extension !';

            if ($error == false) {
                $_POST = Gump::sanitize($_POST);
                $f = 'app/templates/default/img/'.uniqid().$extension;

                if (move_uploaded_file($_FILES['fichier']['tmp_name'], $f)) {
                    $p = new Photo($_POST['nom'], $f, date("Y-a-d h:i:s"), $_POST['style'], Session::get('id'));
                    EntityManager::getInstance()->save($p);
                    Url::redirect();

                }else
                $error = "Problème transfert";
            }else
            {
                echo $error;
                print_r($_FILES);
                die(1);
            }

        }

    }

    public function supprimer($id){
        $sql = new PhotoSQL();
        $p = $sql->findByID($id);
        if($p!=false && $p->utilisateur_id==Session::get('id')) {
            unlink($p->fichier);
            EntityManager::getInstance()->delete($p);
        }

        Url::previous();
    }

    public function ajoutalbum() {
        if(isset($_POST['nom']) && Session::get('id')!=null){
            $_POST = Gump::sanitize($_POST);
            $a = new Album($_POST['nom'],Session::get('id'));
            EntityManager::getInstance()->save($a);
        }
        Url::previous();
    }

    public function lier($idAlbum,$idPhoto){
        $sql = new AlbumSQL();
        $a = $sql->findById($idAlbum);

        if($a->utilisateur_id == Session::get('id')){
            // $pdo = DBManager::getInstance()->getPdo();
            // $q = $pdo->prepare("DELETE FROM contient WHERE photo_id=?");
            // $q->execute(array($idPhoto));
            // nique tout le reste

            
            $c = new Contient($idAlbum,$idPhoto);
            EntityManager::getInstance()->save($c);
        }

       // Url::previous();
    }
}







