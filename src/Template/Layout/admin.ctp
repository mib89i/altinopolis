<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="altinopolis">
    <?= $this->Html->css('offcanvas.css') ?>
    <?= $this->Html->css('dashboard.css'); ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->script('ie-emulation-modes-warning.js'); ?>
    <?= $this->Html->script('ie10-viewport-bug-workaround.js'); ?>
</head>
<body>
    <?php if (isset($user_session['username'])): ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navegação</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            
          </button>
          <?php echo $this->Html->link('Cidade de Altinópolis', ['controller' => 'painel', 'action' => 'index'], ['class'=>'navbar-brand']); ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($user_session['username'])): ?>
                <li><?php echo $this->Html->link('Meu Cadastro', ['controller' => 'users', 'action' => 'account']); ?></li>
                <li><a href="#"><?php echo $user_session['name']; ?></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Meu Painel<span class="caret"></span></a>
                  
                  <ul class="dropdown-menu">
            <li class='<?php if ($this->request->session()->read('link_actived') === 'users'){echo 'active';}?>'>
                <?php echo $this->Html->link('Usuários', ['controller' => 'users']); ?>
            </li>
            <li class='<?php if ($this->request->session()->read('link_actived') === 'categorias'){echo 'active';}?>'>
                <?php echo $this->Html->link('Categorias', ['controller' => 'categorias']); ?>
            </li>
            <li class='<?php if ($this->request->session()->read('link_actived') === 'noticias'){echo 'active';}?>'>
                <?php echo $this->Html->link('Notícias', ['controller' => 'noticias']); ?>
            </li>
            <li class='<?php if ($this->request->session()->read('link_actived') === 'albuns'){echo 'active';}?>'>
                <?php echo $this->Html->link('Albuns', ['controller' => 'albuns']); ?>
            </li>
                  </ul>
                </li>            
                <li><?php echo $this->Html->link('SAIR', ['controller' => 'users', 'action' => 'logout']); ?></li>
            <?php endif; ?>            
          </ul>
            <ul>                
            </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class='<?php if ($this->request->session()->read('link_actived') === 'painel'){echo 'active';}?>'>
                <?php echo $this->Html->link('Painel', ['controller' => 'painel']); ?>
            </li>
            <li class='<?php if ($this->request->session()->read('link_actived') === 'users'){echo 'active';}?>'>
                <?php echo $this->Html->link('Usuários', ['controller' => 'users']); ?>
            </li>
            <li class='<?php if ($this->request->session()->read('link_actived') === 'categorias'){echo 'active';}?>'>
                <?php echo $this->Html->link('Categorias', ['controller' => 'categorias']); ?>
            </li>
            <li class='<?php if ($this->request->session()->read('link_actived') === 'noticias'){echo 'active';}?>'>
                <?php echo $this->Html->link('Notícias', ['controller' => 'noticias']); ?>
            </li>
            <li class='<?php if ($this->request->session()->read('link_actived') === 'albuns'){echo 'active';}?>'>
                <?php echo $this->Html->link('Albuns', ['controller' => 'albuns']); ?>
            </li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?= $this->Flash->render(); ?>
            <?= $this->Flash->render('auth'); ?>
            <?php if (isset($noticia_session)): ?>
                <div class="panel panel-default">
                    <div class="panel-body" style="background: #F5A9A9">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5><b>SELECIONE OU CRIE UM ÁLBUM PARA NOTÍCIA:</b></h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <blockquote>
                                    <h5><b><?php echo $noticia_session['title']; ?></b></h5>
                                    <h6><b><?php echo $noticia_session['subtitle']; ?></b></h6>
                                </blockquote>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $this->Html->link('Voltar Para Notícias', ['controller' => 'noticias', 'action' => 'edit', $noticia_session['id']], ['class' => 'btn btn-default btn-block']); ?>
                            </div>
                            <div class="col-lg-1">
                                <?php echo $this->Html->link('X', ['controller' => 'noticias', 'action' => 'excluir_sessao_album_noticia'], ['class' => 'btn btn-danger btn-block']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?= $this->fetch('content'); ?>
        </div>
      </div>
    </div> 
    <?php else: ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
        <?= $this->fetch('content') ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="altinopolis"></script>
        <?= $this->Html->script('offcanvas.js'); ?>
    </footer>
</body>
</html>
