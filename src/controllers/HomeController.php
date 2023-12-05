<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class HomeController extends Controller
{

  private $logged_user;

  public function __construct()
  {
    $this->logged_user = LoginHandler::checkLogin();

    if (!$this->logged_user) $this->redirect('/login');
  }

  public function index()
  {

    $this->render('home', [
      'user' => $this->logged_user
    ]);
  }
}
