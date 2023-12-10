<div class="box feed-new">
  <div class="box-body">
    <div class="feed-new-editor m-10 row">
      <div class="feed-new-avatar">
        <img src="media/avatars/<?= $user->getAvatar() ?>" />
      </div>
      <div class="feed-new-input-placeholder">O que você está pensando, <?= $user->getName() ?>?</div>
      <div class="feed-new-input" contenteditable="true"></div>
      <div class="feed-new-send">
        <img src="assets/images/send.png" />
      </div>
      <form id="form-content" method="POST" action="/post">
        <input type="hidden" name="body">
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  const form = document.querySelector('#form-content');
  const postContent = document.querySelector('.feed-new-input');
  const button = document.querySelector('.feed-new-send');

  button.addEventListener('click', (e) => {
    e.preventDefault();

    const postValue = postContent.innerText.trim()

    if (!postValue) return;
    
    form.querySelector('input[name=body]').value = postValue;

    form.submit();
  });
</script>