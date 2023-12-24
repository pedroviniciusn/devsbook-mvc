<div class="row">
  <div class="box flex-1 border-top-flat">
    <div class="box-body">
      <div class="profile-cover" style="background-image: url('media/covers/<?= $user->getCover() ?>');"></div>
      <div class="profile-info m-20 row">
        <div class="profile-info-avatar">
          <a href="/profile?id=<?= $user->getId(); ?>">
            <img src="media/avatars/<?= $user->getAvatar(); ?>" />
          </a>
        </div>
        <div class="profile-info-name">
          <div class="profile-info-name-text">
            <a href="/profile?id=<?= $user->getId(); ?>">
              <?= $user->getName() ?>
            </a>
          </div>
          <div class="profile-info-location"><?= $user->getCity() ? $user->getCity() : 'Não Informado' ?></div>
        </div>
        <div class="profile-info-data row">
          <?php if ($user->getId() != $loggedUser->getId()) : ?>
            <div class="profile-info-item m-width-20">
              <a class="button" href="/profile/follow/<?= $user->getId() ?>"><?= $isFollowing ? 'Seguindo' : 'Seguir'; ?></a>
            </div>
          <?php endif; ?>
          <div class="profile-info-item m-width-20">
            <a href="/friends?id=<?= $user->getId(); ?>">
              <div class="profile-info-item-n"><?= count($user->getFollowers()); ?></div>
              <div class="profile-info-item-s">Seguidores</div>
            </a>
          </div>
          <div class="profile-info-item m-width-20">
            <a href="/friends?id=<?= $user->getId(); ?>">
              <div class="profile-info-item-n"><?= count($user->getFollowing()); ?></div>
              <div class="profile-info-item-s">Seguindo</div>
            </a>
          </div>
          <div class="profile-info-item m-width-20">
            <a href="/photos?id=<?= $user->getId(); ?>">
              <div class="profile-info-item-n"><?= count($user->getPhotos()); ?></div>
              <div class="profile-info-item-s">Fotos</div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>