<?php

namespace src\handlers;

use src\models\Post;
use src\models\User;
use src\models\User_Relation;

class PostHandler
{
  public static function createPost($userId, $type, $content)
  {
    if (!empty($userId) && !empty($content)) {
      Post::insert([
        'id_user' => $userId,
        'type' => $type,
        'created_at' => date('Y-m-d H:i:s'),
        'body' => $content
      ])->execute();
    }
  }

  public static function getHomePosts($userId, $page)
  {
    $users = User_Relation::select()->where('user_from', $userId)->get();
    $usersFollowing = [];

    foreach ($users as $user) {
      $usersFollowing[] = $user['user_to'];
    }

    $usersFollowing[] = $userId;

    $postsPerpage = 2;

    $posts = Post::select()
      ->where('id_user', 'in', $usersFollowing)
      ->orderBy('created_at', 'desc')
      ->page($page, $postsPerpage)
      ->get();

    $postsCount = Post::select()
      ->where('id_user', 'in', $usersFollowing)
      ->count();

    $pageCount = ceil($postsCount / $postsPerpage);

    $postsHome = [];

    foreach ($posts as $post) {
      $user = User::select()->where('id', $post['id_user'])->one();

      $postMine = false;

      if ($post['id_user'] == $user['id']) $postMine = true;

      $postsHome[] = [
        'id' => $post['id'],
        'type' => $post['type'],
        'created_at' => $post['created_at'],
        'mine' => $postMine,
        'body' => $post['body'],
        'likeCount' => 1,
        'comments' => [],
        'user' => [
          'id' => $user['id'],
          'name' => $user['name'],
          'avatar' => $user['avatar']
        ]
      ];
    }

    return [
      'posts' => $postsHome,
      'pageCount' => $pageCount,
      'currentPage' => $page
    ];
  }
}
