<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Devsbook</title>
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <header>
    <div class="container">
      <div class="logo">
        <a href="/"><img src="assets/images/devsbook_logo.png" /></a>
      </div>
      <div class="head-side">
        <div class="head-side-left">
          <div class="search-area">
            <form method="GET">
              <input type="search" placeholder="Pesquisar" name="s" />
            </form>
          </div>
        </div>
        <div class="head-side-right">
          <a href="/profile" class="user-area">
            <div class="user-area-text"><?= $user->getName(); ?></div>
            <div class="user-area-icon">
              <img src="media/avatars/<?= $user->getAvatar(); ?>" />
            </div>
          </a>
          <a href="/logout" class="user-logout">
            <img src="assets/images/power_white.png" />
          </a>
        </div>
      </div>
    </div>
  </header>