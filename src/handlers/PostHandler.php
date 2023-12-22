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

  public static function getUserPosts($userId, $page)
  {
    $postsPerpage = 2;

    $posts = Post::select()
      ->where('id_user', $userId)
      ->orderBy('created_at', 'desc')
      ->page($page, $postsPerpage)
      ->get();

    $postsCount = Post::select()
      ->where('id_user', $userId)
      ->count();

    $pageCount = ceil($postsCount / $postsPerpage);

    $userPosts = [];

    foreach ($posts as $post) {
      $user = User::select()->where('id', $post['id_user'])->one();

      $postMine = false;

      if ($post['id_user'] == $user['id']) $postMine = true;

      $userPosts[] = [
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
      'posts' => $userPosts,
      'pageCount' => $pageCount,
      'currentPage' => $page
    ];
  }

  public static function getPhotos($userId)
  {
    $photosResponse = [];

    $photos = Post::select()
      ->where('id_user', $userId)
      ->where('type', 'photo')
      ->get();

      foreach ($photos as $photo) {
        $post = new Post();
        $post->setId($photo['id']);
        $post->setUserId($photo['id_user']);
        $post->setType($photo['type']);
        $post->setBody($photo['body']);
        $post->setCreatedAt($photo['created_at']);

        $photosResponse[] = $post;
      }

      return $photosResponse;
  }
}
