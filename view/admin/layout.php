<!doctype html>
<html>
    <head>
        <title>
            Football
        </title>
        <meta charset="utf-8">

        <link rel="stylesheet" href="<?php echo url('/css/bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?php echo url('/css/main.css'); ?>">
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
                  <a class="navbar-brand" href="<?php echo url(url_for('admin')) ?>">My football - админ панель</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo url(url_for('admin_teams')) ?>">Команды</a></li>
                    <li><a href="<?php echo url(url_for('admin_games')) ?>">Матчи</a></li>
                    <li><a href="<?php echo url(url_for('admin_players_new')) ?>">Создать игрока</a></li>
                    <li><a href="<?php echo url(url_for('logout')) ?>">Выйти</a></li>
                  </ul>
                </div>
              </div>
            </nav>        
        </header>        

        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <?php if($message): ?>
                    <div class="alert alert-success">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                
                <?php include($path); ?>
            </div>
        </div>

        <script src="<?php echo url('/scripts/jquery-1.12.1.js'); ?>"></script>        
        <script src="<?php echo url('/scripts/bootstrap.js'); ?>"></script>
    </body>
</html>