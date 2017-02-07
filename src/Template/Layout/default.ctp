<!DOCTYPE html>
<!--[if lt IE 7 ]> <html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js ie ie6 lte6 lte7 lte8 lte9 jqueryui-com jquery-ui" dir="ltr" lang="pt-BR"> <![endif]-->
<!--[if IE 7 ]>		 <html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js ie ie7 lte7 lte8 lte9 jqueryui-com jquery-ui" dir="ltr" lang="pt-BR"> <![endif]-->
<!--[if IE 8 ]>		 <html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js ie ie8 lte8 lte9 jqueryui-com jquery-ui" dir="ltr" lang="pt-BR"> <![endif]-->
<!--[if IE 9 ]>		 <html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js ie ie9 lte9 jqueryui-com jquery-ui" dir="ltr" lang="pt-BR"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> -->
        <title><?= empty($title) ? "" : $title; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
        <meta name="description" content="<?= empty($meta_description) ? "" : $meta_description; ?>" />
        <meta name="keywords" content="<?= empty($meta_keyworks) ? "" : $meta_keyworks; ?>" />
        <!-- // FACEBOOK -->
        <!-- <meta property="fb:app_id" content="" /> -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Cidade de Altinópolis" />
        <meta property="og:site_name" content="CidadeAltinopolis.com.br" />
        <!-- <meta property="og:image" content="logo-128x128x.png" /> -->
        <meta property="og:url" content="http://www.cidadealtinopolis.com.br/" />
        <!-- // FACEBOOK -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/journal/bootstrap.min.css" >
        <!-- // GOOGLE ANALYTICS -->
        <!-- 
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-*********']);
            _gaq.push(['_setDomainName', 'www.cidadealtinopolis.com.br']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>
        -->

        <!-- // GOOGLE ANALYTICS -->
    </head>
    <body >
        <div class="container" style="margin-top: 0px">
            <?= $this->Html->image('background_top.jpg', ['class' => 'img-responsive', 'syle="margin-top:0px"']); ?>                
            <nav class="navbar navbar-default" style="border-radius: 0">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Navegar</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php echo $this->Html->link('Cidade de Altinópolis', array('controller' => 'Home', 'action' => 'index'), array('class' => 'navbar-brand')); ?>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <!-- <li><?php echo $this->Html->link('NOTÍCIAS', array('controller' => 'Noticias', 'action' => 'index')); ?></li> -->
                            <li class="active"></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            echo $this->Form->create(false, array(
                                'url' => '/noticias/find',
                                'type' => 'get',
                                'class' => 'navbar-form navbar-left'
                            ));
                            ?>
                            <div class="input-group">
                                <?= $this->Form->input('search', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Pesquisar...')); ?>
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>                                    
                          </div>

                            <?= $this->Form->end() ?>                            
                            <!-- 
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </li>
                            -->
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

            <?= $this->Flash->render() ?>

            <div>
                <?= $this->fetch('content') ?>
            </div>


        </div>
        <div style="display: block; height: 300px"></div>
        <footer class="footer">
            <div class="navbar navbar-default">
                <div class="container">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Sobre</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="#">Parceiros</a></li>
                        <li><?php echo $this->Html->link('Login', '/admin'); ?></li>
                    </ul>                    
                </div>
            </div>
        </footer>
        <!-- 
        <footer class="footer">
            <div class="container">
                <p class="text-muted">Place sticky footer content here.</p>
            </div>
        </footer>  -->      
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <?= $this->Html->script('ie-emulation-modes-warning.js'); ?>
        <?= $this->Html->script('ie10-viewport-bug-workaround.js'); ?>
    </body>
</html>
