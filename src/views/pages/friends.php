<?= $render('header', [
  'user' => $loggedUser
]); ?>

<section class="container main">
  <?= $render('sidebar', ['activeMenu' => 'friends']); ?>
  <section class="feed">

    <?= $render('profile-header', ['user' => $user, 'loggedUser' => $loggedUser, 'isFollowing' => $isFollowing]); ?>

    <div class="row">
      <div class="column">

        <div class="box">
          <div class="box-body">

            <div class="tabs">
              <div class="tab-item" data-for="followers">
                Seguidores
              </div>
              <div class="tab-item active" data-for="following">
                Seguindo
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-body" data-item="followers">

                <div class="full-friend-list">
                  <?php foreach ($user->getFollowers() as $item) : ?>
                    <div class="friend-icon">
                      <a href="/profile?id=<?= $item->getId(); ?>">
                        <div class="friend-icon-avatar">
                          <img src="media/avatars/<?= $item->getAvatar(); ?>" />
                        </div>
                        <div class="friend-icon-name">
                          <?= $item->getName(); ?>
                        </div>
                      </a>
                    </div>
                  <?php endforeach; ?>
                </div>

              </div>
              <div class="tab-body" data-item="following">

                <div class="full-friend-list">
                  <?php foreach ($user->getFollowing() as $item) : ?>
                    <div class="friend-icon">
                      <a href="/profile?id=<?= $item->getId(); ?>">
                        <div class="friend-icon-avatar">
                          <img src="media/avatars/<?= $item->getAvatar(); ?>" />
                        </div>
                        <div class="friend-icon-name">
                          <?= $item->getName(); ?>
                        </div>
                      </a>
                    </div>
                  <?php endforeach; ?>
                </div>

              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </section>
</section>

<?= $render('footer'); ?>