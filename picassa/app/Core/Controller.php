<?php
/**
 * Controller - base controller
 *
 * @author David Carr - dave@daveismyname.com
 * @version 2.2
 * @date June 27, 2014
 * @date updated Sept 19, 2015
 */

namespace Core;

use Core\View;
use Core\Language;
use Helpers\DB\EntityManager;

/**
 * Core controller, all other controllers extend this base controller.
 */
abstract class Controller
{

    protected $entityManager;
    /**
     * View variable to use the view class.
     *
     * @var string
     */
    public $view;

    /**
     * Language variable to use the languages class.
     *
     * @var string
     */
    public $language;

    /**
     * On run make an instance of the config class and view class.
     */
    public function __construct()
    {
        /** initialise the views object */
        $this->view = new View();

        /** initialise the language object */
        $this->language = new Language();
        $this->entityManager = EntityManager::getInstance();
    }
}
