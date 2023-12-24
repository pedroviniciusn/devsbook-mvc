<?= $render('header', [
  'user' => $loggedUser
]); ?>

<section class="container main">
  <?= $render('sidebar', ['activeMenu' => 'profile']); ?>
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

      <div class="column side pr-5">

        <div class="box">
          <div class="box-body">

            <div class="user-info-mini">
              <img src="assets/images/calendar.png" />
              <?= date('d/m/Y', strtotime($user->getBirthdate())); ?> (<?= $user->getAge(); ?> anos)
            </div>

            <div class="user-info-mini">
              <img src="assets/images/pin.png" />
              <?= $user->getCity() ? $user->getCity() : 'Não Informado' ?>
            </div>

            <div class="user-info-mini">
              <img src="assets/images/work.png" />
              <?= $user->getWork() ? $user->getCity() : 'Não Informado' ?>
            </div>

          </div>
        </div>

        <div class="box">
          <div class="box-header m-10">
            <div class="box-header-text">
              Seguindo
              <span>(<?= count($user->getFollowing()); ?>)</span>
            </div>
            <div class="box-header-buttons">
              <a href="/friends">ver todos</a>
            </div>
          </div>
          <div class="box-body friend-list">

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
      <div class="column pl-5">

        <div class="box">
          <div class="box-header m-10">
            <div class="box-header-text">
              Fotos
              <span>(<?= count($user->getPhotos()); ?>)</span>
            </div>
            <div class="box-header-buttons">
              <a href="/photos?id=<?= $user->getId(); ?>">ver todos</a>
            </div>
          </div>
          <div class="box-body row m-20">

            <?php if (count($user->getPhotos()) === 0) : ?>
              Este usuário não possui fotos.
            <?php endif; ?>

            <?php foreach ($user->getPhotos() as $photo) : ?>
              <div class="user-photo-item">
                <a href="#modal-<?= $photo->getId(); ?>" rel="modal:open">
                  <img src="media/uploads/<?= $photo->getBody(); ?>" />
                </a>
                <div id="modal-<?= $photo->getId(); ?>" style="display:none">
                  <img src="media/uploads/<?= $photo->getBody(); ?>" />
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>

        <?php if ($user->getId() == $loggedUser->getId()) : ?>
          <?= $render('feed-editor', ['user' => $loggedUser]); ?>
        <?php endif; ?>

        <?php foreach ($feed['posts'] as $post) : ?>
          <?= $render('feed-item', ['post' => $post, 'user' => $user]); ?>
        <?php endforeach; ?>

        <div class="feed-pagination">
          <?php for ($i = 0; $i < $feed['pageCount']; $i++) : ?>
            <a class="<?= ($i == $feed['currentPage'] ? 'active' : '') ?>" href="<?= $base; ?>/profile?id=<?= $user->getId() . '?page=' . $i; ?>"><?= $i + 1; ?></a>
          <?php endfor; ?>
        </div>
      </div>

    </div>

  </section>
</section>

<?= $render('footer'); ?>