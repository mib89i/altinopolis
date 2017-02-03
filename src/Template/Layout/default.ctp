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
        <?= $this->Html->css('offcanvas.css'); ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
    <body>
         <?= $this->Html->image('background_top.jpg', ['class' => 'img-responsive']); ?>
        <div class="container">
            <nav class="navbar navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Navegação</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Nome do Site/Logo</a>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><?php echo $this->Html->link('Início', array('controller' => 'Home', 'action' => 'index')); ?></li>
                            <li><a href="noticias.html">Noticias</a></li>
                        </ul>
                    </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
            </nav><!-- /.navbar -->            
    

        <?= $this->Flash->render() ?>

        <div>
            <?= $this->fetch('content') ?>
        </div>

        <div class="navbar navbar-inverse navbar-fixed-bottom">
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

        <footer>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

            <?= $this->Html->script('ie-emulation-modes-warning.js'); ?>
            <?= $this->Html->script('ie10-viewport-bug-workaround.js'); ?>
            <?= $this->Html->script('offcanvas.js'); ?>
        </footer>
    </body>
</html>
