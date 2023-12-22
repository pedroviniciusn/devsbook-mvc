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

    $user = User::select()->where('token', $token)->one();

    if (!count($user) > 0) {
      return false;
    }

    $loggedUser = new User();
    $loggedUser->setId($user['id']);
    $loggedUser->setName($user['name']);
    $loggedUser->setEmail($user['email']);
    $loggedUser->setAvatar($user['avatar']);

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

    User::update()
      ->set('token', $token)
      ->where('email', $email)
      ->execute();

    return $token;
  }
}
