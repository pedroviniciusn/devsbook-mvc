<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\LoginHandler;

class LoginController extends Controller
{

  public function signin()
  {
    $flash = '';

    if (!empty($_SESSION['flash'])) {
      $flash = $_SESSION['flash'];
      $_SESSION['flash'] = '';
    }

    $this->render('signin', [
      'flash' => $flash
    ]);
  }

  public function signinAction($args)
  {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    if (!$email && !$password) {
      $_SESSION['flash'] = 'E-mail e/ou senha não preenchidos';
      $this->redirect('/login');
    }

    $token = LoginHandler::verifyLogin($email, $password);

    if (!$token) {
      $_SESSION['flash'] = 'E-mail e/ou senha incorretos';
      $this->redirect('/login');
    }

    $_SESSION['token'] = $token;

    $this->redirect('/');
  }

  public function signup()
  {
    $flash = '';

    if (!empty($_SESSION['flash'])) {
      $flash = $_SESSION['flash'];
      $_SESSION['flash'] = '';
    }

    $this->render('signup', [
      'flash' => $flash
    ]);
  }

  public function signupAction()
  {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    $birthdate = filter_input(INPUT_POST, 'birthdate');

    if (!$name && !$email && !$password && !$birthdate) {
      $_SESSION['flash'] = 'Precisa preencher todos os campos';
      $this->redirect('/register');
    }

    $birthdate = explode('/', $birthdate);

    if (count($birthdate) != 3) {
      $_SESSION['flash'] = 'Data de nascimento inválida';
      $this->redirect('/register');
    }

    $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];

    if (!strtotime($birthdate)) {
      $_SESSION['flash'] = 'Data de nascimento inválida';
      $this->redirect('/register');
    }

    if (LoginHandler::emailExists($email)) {
      $_SESSION['flash'] = 'E-mail já cadastrado';
      $this->redirect('/register');
    }

    $token = LoginHandler::addUser($name, $email, $password, $birthdate);

    $_SESSION['token'] = $token;

    $this->redirect('/');
  }
}
