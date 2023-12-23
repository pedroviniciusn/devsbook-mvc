<?php

namespace src\handlers;

use src\models\User;
use src\models\User_Relation;

class UserHandler
{

  public static function idExists($id)
  {
    $user = User::select()->where('id', $id)->one();
    return $user ? true : false;
  }

  public static function emailExists($email)
  {
    $user = User::select()->where('email', $email)->one();
    return $user ? true : false;
  }

  public static function addUser($name, $email, $password, $birthdate)
  {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $token = md5(time() . rand(0, 9999) . time());

    User::insert([
      'name' => $name,
      'email' => $email,
      'password' => $hash,
      'birthdate' => $birthdate,
      'avatar' => 'default.jpg',
      'cover' => 'cover.jpg',
      'token' => $token
    ])->execute();

    return $token;
  }

  public static function getUser($id, $full = false)
  {
    $user = User::select()->where('id', $id)->one();

    if (!$user) {
      return false;
    }

    $userObj = new User();
    $userObj->setId($user['id']);
    $userObj->setName($user['name']);
    $userObj->setBirthdate($user['birthdate']);
    $userObj->setAvatar($user['avatar']);
    $userObj->setCity($user['city']);
    $userObj->setWork($user['work']);
    $userObj->setCover($user['cover']);

    $today = new \DateTime(date('Y-m-d'));
    $birthdate = new \DateTime($user['birthdate']);
    $age = $today->diff($birthdate)->y;

    $userObj->setAge($age);

    if ($full) {
      $followingArray = [];
      $followersArray = [];

      $followers = User_Relation::select()->where('user_from', $id)->get();

      foreach ($followers as $userFollower) {
        $userData = User::select()->where('id', $userFollower['user_to'])->one();

        $newUser = new User();
        $newUser->setId($userData['id']);
        $newUser->setName($userData['name']);
        $newUser->setAvatar($userData['avatar']);
        $followingArray[] = $newUser;
      }

      $following = User_Relation::select()
        ->where('user_to', $id)
        ->get();

      foreach ($following as $userFollowing) {
        $userData = User::select()->where('id', $userFollowing['user_from'])->one();

        $newUser = new User();
        $newUser->setId($userData['id']);
        $newUser->setName($userData['name']);
        $newUser->setAvatar($userData['avatar']);
        $followingArray[] = $newUser;
      }

      $userObj->setFollowing($followingArray);
      $userObj->setFollowers($followersArray);

      $photos = PostHandler::getPhotos($id);

      $userObj->setPhotos($photos);
    }

    return $userObj;
  }

  public static function isFollowing($from, $to)
  {
    $data = User_Relation::select()
      ->where('user_from', $from)
      ->where('user_to', $to)
      ->one();

    if ($data) {
      return true;
    }

    return false;
  }

  public static function follow($from, $to)
  {
    User_Relation::insert([
      'user_from' => $from,
      'user_to' => $to
    ])->execute();
  }

  public static function unfollow($from, $to)
  {
    User_Relation::delete()
      ->where('user_from', $from)
      ->where('user_to', $to)
      ->execute();
  }
}
