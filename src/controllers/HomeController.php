<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;
use src\handlers\PostHandler;

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
    $page = intval(filter_input(INPUT_GET, 'page'));

    $homePosts = PostHandler::getHomePosts(
      $this->logged_user->getId(),
      $page
    );

    $this->render('home', [
      'user' => $this->logged_user,
      'homePosts' => $homePosts
    ]);
  }
}
