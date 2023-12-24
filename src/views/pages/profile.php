<?= $render('header', [
  'user' => $loggedUser
]); ?>

<section class="container main">
  <?= $render('sidebar', ['activeMenu' => 'profile']); ?>
  <section class="feed">

  <?= $render('profile-header', ['user' => $user, 'loggedUser' => $loggedUser, 'isFollowing' => $isFollowing]); ?>

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