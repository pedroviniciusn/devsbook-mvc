<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;
use src\handlers\PostHandler;

class PostController extends Controller
{

  private $logged_user;

  public function __construct()
  {
    $this->logged_user = LoginHandler::checkLogin();

    if (!$this->logged_user) $this->redirect('/login');
  }

  public function create()
  {

    $postContent = filter_input(INPUT_POST, 'body');

    if (!$postContent) $this->redirect('/');

    PostHandler::createPost(
      $this->logged_user->getId(),
      'text',
      $postContent
    );

    $this->redirect('/');

    $this->render('home', [
      'user' => $this->logged_user
    ]);
  }
}
