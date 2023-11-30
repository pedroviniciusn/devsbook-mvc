<?php

namespace src\handlers;

use src\models\User;

class LoginHandler
{
  public static function checkLogin()
  {
    if (empty($_SESSION['token'])) {
      return false;
    }

    $token = $_SESSION['token'];

    $data = User::select()->where('token', $token)->one();

    if (!count($data) > 0) {
      return false;
    }

    $loggedUser = new User();
    // $loggedUser->setId($data['id']);
    // $loggedUser->setName($data['name']);
    // $loggedUser->setEmail($data['email']);

    return $loggedUser;
  }

  public static function verifyLogin($email, $password)
  {
    $user = User::select()->where('email', $email)->one();

    if (!$user) {
      return false;
    }

    if (!password_verify($password, $user['password'])) {
      return false;
    }

    $token = md5(time() . rand(0, 9999) . time());

    $user::update()
      ->set('token', $token)
      ->where('email', $email)
      ->execute();

    return $token;
  }
}
