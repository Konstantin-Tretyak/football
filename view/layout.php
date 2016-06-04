<!doctype html>
<html>
    <head>
        <title>
            Football
        </title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="<?php echo url('/css/bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('/css/main.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('/css/whirl.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('/css/pnotify.custom.min.css'); ?>">
    </head>
    <body>

        <header>
            <nav class="navbar navbar-default">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="<?php echo url(url_for('main')) ?>">My football</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo url(url_for('main')) ?>">Матчи</a></li>
                    <?php if ($current_user): ?>
                        <li><a href="<?php echo url(url_for('user')) ?>">Мои команды</a></li>
                        <?php if ($current_user->is_admin): ?>
                            <li><a href="<?php echo url(url_for('admin')) ?>">Админ панель</a></li>
                        <?php endif; ?>                    
                        <li><a href="<?php echo url(url_for('logout')) ?>">Выйти</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo url(url_for('login')) ?>">Войти</a></li>
                    <?php endif; ?>                    

                  </ul>
                </div>
              </div>
            </nav>        

        </header>

        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <?php include($path); ?>
            </div>
        </div>

        <script src="<?php echo url('/scripts/jquery-1.12.1.js'); ?>"></script>
        <script src="<?php echo url('/scripts/bootstrap.js'); ?>"></script>

        <script src="<?php echo url('/scripts/pnotify.custom.min.js'); ?>"></script>
        <script src="<?php echo url('/scripts/app.js'); ?>"></script>
        <script src="<?php echo url('/scripts/users_liked.js'); ?>"></script>
        <script src="<?php echo url('/scripts/comments.js'); ?>"></script>

    </body>
</html>
