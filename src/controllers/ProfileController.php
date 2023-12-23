<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;
use src\handlers\PostHandler;
use \src\handlers\UserHandler;

class ProfileController extends Controller
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

    $id = $this->logged_user->getId();

    if (intval(filter_input(INPUT_GET, 'id'))) $id = intval(filter_input(INPUT_GET, 'id'));

    $user = UserHandler::getUser($id, true);

    if (!$user) {
      $this->redirect('/');
    }

    $feed = PostHandler::getUserPosts($id, $page);

    $isFollowing = false;

    if ($user->getId() != $this->logged_user->getId()) {
      $isFollowing = UserHandler::isFollowing($this->logged_user->getId(), $user->getId());
    }


    return $this->render('profile', [
      'loggedUser' => $this->logged_user,
      'user' => $user,
      'feed' => $feed,
      'isFollowing' => $isFollowing,
    ]);
  }

  public function friends($args = [])
  {

    $id = $this->logged_user->getId();

    if (isset($args['id'])) $id = intval($args['id']);

    $user = UserHandler::getUser($id, true);

    if (!$user) {
      $this->redirect('/');
    }

    $isFollowing = false;

    if ($user->getId() != $this->logged_user->getId()) {
      $isFollowing = UserHandler::isFollowing($this->logged_user->getId(), $user->getId());
    }

    $this->render('friends', [
      'loggedUser' => $this->logged_user,
      'user' => $user,
      'isFollowing' => $isFollowing,
    ]);
  }

  public function follow($args = [])
  {
    $userTo = intval($args['id']);

    if (UserHandler::idExists($userTo)) {
      if (UserHandler::isFollowing($this->logged_user->getId(), $userTo)) {
        UserHandler::unfollow($this->logged_user->getId(), $userTo);
      } else {
        UserHandler::follow($this->logged_user->getId(), $userTo);
      }
    }

    return $this->redirect('/profile?id=' . $userTo);
  }
}
