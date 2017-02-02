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
            <?php echo $this->Html->link('Painel de Controle', ['controller' => 'users', 'action' => 'painel']); ?>
          </button>
          <a class="navbar-brand" href="dashboard.html">Nome do Site / Logo</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($user_session['username'])): ?>
                <li><?php echo $this->Html->link('Conta', ['controller' => 'contas', 'action' => 'contas']); ?></li>
                <li><?php echo $this->Html->link('Preferências', ['controller' => 'preferencias', 'action' => 'add']); ?></li>
                <li><a href="#"><?php echo $user_session['username']; ?></a></li>
                <li><?php echo $this->Html->link('SAIR', ['controller' => 'users', 'action' => 'logout']); ?></li>
            <?php endif; ?>            
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Pesquisar notícias...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class='<?php if ($this->request->session()->read('link_actived') === 'meu-painel'){echo 'active';}?>'>
              <?php echo $this->Html->link('MEU PAINEL', ['controller' => 'users']); ?>
            </li>
            <li class='<?php if ($this->request->session()->read('link_actived') === 'usuarios'){echo 'active';}?>'>
                <?php echo $this->Html->link('Usuários', ['controller' => 'usuarios']); ?>
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
          <?= $this->Flash->render() ?>
          <?= $this->fetch('content') ?>
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
