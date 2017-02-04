<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> -->
        <title>Cidade de Altinópolis</title>
        <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
        <meta name="description" content="Portal de notícias da cidade altinópilis" />
        <meta name="keywords" content="altinopolis, noticas, portal, turismo" />
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
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php echo $this->Html->link('Início', array('controller' => 'Home', 'action' => 'index'), array('class'=>'navbar-brand')); ?>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><?php echo $this->Html->link('NOTÍCIAS', array('controller' => 'Noticias', 'action' => 'index')); ?></li>
                            <li class="active"></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <form class="navbar-form navbar-left">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Pesquisar...">
                                </div>
                            </form>
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


        <footer>
            <div class="navbar navbar-default navbar-fixed-bottom">
                <div class="container">
                    <div class="navbar-collapse collapse" id="footer-body">
                        <ul class="nav navbar-nav">
                            <li><a href="#">Sobre</a></li>
                            <li><a href="#">Contato</a></li>
                            <li><a href="#">Parceiros</a></li>
                            <li><?php echo $this->Html->link('Login', '/admin'); ?></li>
                        </ul>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#footer-body">
                            <span style="color: white;">^</span>
                            <span><br /></span>
                            <span class="icon-bar"></span>
                        </button>
                        <ul class="footer-bar-btns visible-xs">
                            <li><a href="#" class="btn" title="History"><i class="fa fa-2x fa-clock-o blue-text"></i></a></li>
                            <li><a href="#" class="btn" title="Favourites"><i class="fa fa-2x fa-star yellow-text"></i></a></li>
                            <li><a href="#" class="btn" title="Subscriptions"><i class="fa fa-2x fa-rss-square orange-text"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

            <?= $this->Html->script('ie-emulation-modes-warning.js'); ?>
            <?= $this->Html->script('ie10-viewport-bug-workaround.js'); ?>
        </footer>
    </body>
</html>
