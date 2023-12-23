<?= $render('header', [
  'user' => $loggedUser
]); ?>

<section class="container main">
  <?= $render('sidebar', ['activeMenu' => 'friends']); ?>
  <section class="feed">

    <div class="row">
      <div class="box flex-1 border-top-flat">
        <div class="box-body">
          <div class="profile-cover" style="background-image: url('media/covers/<?= $user->getCover() ?>');"></div>
          <div class="profile-info m-20 row">
            <div class="profile-info-avatar">
              <img src="media/avatars/<?= $user->getAvatar(); ?>" />
            </div>
            <div class="profile-info-name">
              <div class="profile-info-name-text"><?= $user->getName() ?></div>
              <div class="profile-info-location"><?= $user->getCity() ? $user->getCity() : 'Não Informado' ?></div>
            </div>
            <div class="profile-info-data row">
              <?php if ($user->getId() != $loggedUser->getId()) : ?>
                <div class="profile-info-item m-width-20">
                  <a class="button" href="/profile/follow/<?= $user->getId() ?>"><?= $isFollowing ? 'Seguindo' : 'Seguir'; ?></a>
                </div>
              <?php endif; ?>
              <div class="profile-info-item m-width-20">
                <div class="profile-info-item-n"><?= count($user->getFollowers()); ?></div>
                <div class="profile-info-item-s">Seguidores</div>
              </div>
              <div class="profile-info-item m-width-20">
                <div class="profile-info-item-n"><?= count($user->getFollowing()); ?></div>
                <div class="profile-info-item-s">Seguindo</div>
              </div>
              <div class="profile-info-item m-width-20">
                <div class="profile-info-item-n"><?= count($user->getPhotos()); ?></div>
                <div class="profile-info-item-s">Fotos</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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