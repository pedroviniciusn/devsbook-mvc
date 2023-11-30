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
    <form method="POST" action="/register">
      <?php if (!empty($flash)) : ?>
        <span class="flash">
          <?php echo $flash; ?>
        </span>
      <?php endif; ?>

      <input placeholder="Digite seu Nome" class="input" type="text" name="name" />

      <input placeholder="Digite seu E-mail" class="input" type="email" name="email" />

      <input placeholder="Digite sua senha" class="input" type="password" name="password" />

      <input placeholder="Digite sua Data de Nascimento" class="input" type="text" name="birthdate" id="birthdate" />

      <input class="button" type="submit" value="Realizar cadastro" />

      <a href="/login">Já tem uma conta? Entrar</a>
    </form>
  </section>

  <script src="https://unpkg.com/imask"></script>
  <script>
    IMask(
      document.getElementById('birthdate'), {
        mask: '00/00/0000'
      }
    );
  </script>
</body>

</html>