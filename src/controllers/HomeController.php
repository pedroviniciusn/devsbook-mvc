<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class HomeController extends Controller
{

  private $logged_user;

  public function __construct()
  {
    $logged_user = LoginHandler::checkLogin();

    if (!$logged_user) $this->redirect('/login');
  }

  public function index()
  {
    echo 'HOME';
    // $this->render('home');
  }
}
