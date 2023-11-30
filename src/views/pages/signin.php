<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title></title>
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
  <link rel="stylesheet" href="/assets/css/login.css?v=<?php echo time(); ?>" />
</head>

<body>
  <header>
    <div class="container">
      <a href=""><img src="assets/images/devsbook_logo.png" /></a>
    </div>
  </header>
  <section class="container main">
    <form method="POST" action="/login">
      <?php if (!empty($flash)) : ?>
        <span class="flash">
          <?php echo $flash; ?>
        </span>
      <?php endif; ?>

      <input placeholder="Digite seu E-mail" class="input" type="email" name="email" />

      <input placeholder="Digite sua Senha" class="input" type="password" name="password" />

      <input class="button" type="submit" value="Acessar o sistema" />

      <a href="/register">Ainda não tem uma conta? Cadastre-se</a>
    </form>
  </section>
</body>

</html>