<div class="box feed-item">
  <div class="box-body">
    <div class="feed-item-head row mt-20 m-width-20">
      <div class="feed-item-head-photo">
        <a href=""><img src="media/avatars/default.jpg" /></a>
      </div>
      <div class="feed-item-head-info">
        <a href=""><span class="fidi-name"><?= $post['user']['name']; ?></span></a>
        <span class="fidi-action">
          <?php switch ($post['type']) {
            case 'text':
              echo 'fez um post';
              break;
            case 'photo':
              echo 'postou uma foto';
              break;
          } ?>
        </span>
        <br />
        <span class="fidi-date"><?= date('d/m/y', strtotime($post['created_at'])); ?></span>
      </div>
      <div class="feed-item-head-btn">
        <img src="assets/images/more.png" />
      </div>
    </div>
    <div class="feed-item-body mt-10 m-width-20">
      <?= nl2br($post['body']); ?>
    </div>
    <div class="feed-item-buttons row mt-20 m-width-20">
      <div class="like-btn on"><?= $post['likeCount']; ?></div>
      <div class="msg-btn"><?= count($post['comments']); ?></div>
    </div>
    <div class="feed-item-comments">

      <!-- <div class="fic-item row m-height-10 m-width-20">
        <div class="fic-item-photo">
          <a href=""><img src="media/avatars/<?= $post['user']['avatar']; ?>" /></a>
        </div>
        <div class="fic-item-info">
          <a href=""><?= $post['user']['name']; ?></a>
          Comentando no meu próprio post
        </div>
      </div> -->

      <div class="fic-answer row m-height-10 m-width-20">
        <div class="fic-item-photo">
          <a href="#"><img src="media/avatars/<?= $user->getAvatar(); ?>" /></a>
        </div>
        <input type="text" class="fic-item-field" placeholder="Escreva um comentário" />
      </div>

    </div>
  </div>
</div>