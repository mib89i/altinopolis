<style type="text/css">
    .panel-transparent {
        background: rgba(46, 51, 56, 0.2)!important;
    }
    .img-news .img-responsive {
        margin: 0 auto;
    }    
    .min-height-200 { min-height: 150px;} 
    .img-news-top {margin-top: 15px} 

    .carousel-control {background: transparent!important}

    @media (max-width: 767px) {
        .carousel-inner > .item > img {
            width: 100%;
            height: 250px;
        }
    }

    @media (min-width: 768px) {
        .carousel-inner > .item > img {
            width: 100%;
            height: 350px;
        }
    }
    .news-title-bg {
        opacity: 0.6;
        filter: alpha(opacity=0); /* For IE8 and earlier */          
        background: transparent;
        border-radius: 5px;
    }

    .news-title {
        display: block;
        width: 100%;        
        height: 250px;        
        opacity: 1;
        filter: alpha(opacity=0); /* For IE8 and earlier */            
        color: transparent;
        padding: 5px;
    }

    .carousel-caption {

    }   
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="visible-xs">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">AUTORES
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <?php foreach ($lista_usuarios as $lu): ?>
                        <li>
                            <?php echo $this->Html->link($lu['name'], ['controller' => 'noticias', 'action' => 'autor', $lu['id'], \Cake\Utility\Inflector::slug(strtolower($lu['name']))], array('escape' => false)); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <br />
        </div> 
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-6">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom: 10px; overflow: hidden">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <!-- 
                        <?php // $i = 0; ?>
                        <?php foreach ($lista_destaques_img as $noticias): ?>
                                <span href="#" data-target="#myCarousel" data-slide-to="<?= $i; ?>" class="<?= ($i === 0 ) ? 'active' : ''; ?>" style="cursor: pointer;" >
                            <?php // = $this->Html->image('albuns/' . $noticias['gallery_id'] . '/thumb_' . $noticias['album']['capa']['name'], ['class' => 'img-rounded', 'width' => '40', 'height' => '40', 'title' => $noticias['title']]); ?>
                                </span >
                            <?php // $i++; ?>
                        <?php endforeach; ?>
                        -->
                    </div>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php $i = 0; ?>
                        <?php foreach ($lista_destaques_img as $noticias): ?>
                            <div class="item <?= ($i === 0 ) ? 'active' : ''; ?>">
                                <div class="carousel-caption" style="margin-bottom: 10px">
                                    <div class="news-title-bg">
                                        <?php echo $this->Html->link('<span class="news-title" title=' . $this->Strings->abreviar($noticias['title'], 150) . '></span>', ['controller' => 'noticias', 'action' => 'view', $noticias['id'], \Cake\Utility\Inflector::slug(strtolower($noticias['title']))], array('escape' => false, 'title' => $noticias['title'])); ?>                                                                                    
                                    </div>
                                </div>
                                <?= $this->Html->image('albuns/' . $noticias['gallery_id'] . '/thumb_slide_' . $noticias['album']['capa']['name'], ['alt' => $this->Strings->abreviar($noticias['title'], 150), 'title' => $this->Strings->abreviar($noticias['title'], 150)]); ?>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Voltar</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Avançar</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <cite>DESTAQUES</cite>
                <?php foreach ($lista_destaques as $noticia): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>
                                <?php echo $this->Html->link($this->Strings->abreviar($noticia['title'], 60), ['controller' => 'noticias', 'action' => 'view', $noticia['id'], \Cake\Utility\Inflector::slug(strtolower($noticia['title']))], array('escape' => false, 'style' => 'color:black', 'title' => $noticia['title'])); ?>
                            </h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>                
        </div>
        <div class="row" style="margin-top: 15px">
            <div class="col-lg-12">
                <cite>MAIS NOTÍCIAS</cite>
                <div class="row">
                    <?php foreach ($lista_noticias as $noticia): ?>
                        <?php /* debug($noticia); */ ?>
                        <div class="col-lg-4 min-height-200">
                            <div class="row">
                                <?php if ($noticia['gallery_id'] !== NULL) { ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 no-padding-img">
                                        <div>
                                            <?= $this->Html->image('albuns/' . $noticia['album']['id'] . '/' . 'thumb_' . $noticia['album']['capa']['name'], ['class' => 'img-responsive img-news-top', 'alt' => '']); ?>
                                        </div>
                                    </div>
                                <?php } ?>                                
                                <div class="<?= ($noticia['gallery_id'] !== NULL) ? 'col-lg-8 col-md-8 col-sm-8 col-xs-8' : 'col-lg-12'; ?>  no-padding-img">
                                    <h4>
                                        <?php echo $this->Html->link($this->Strings->abreviar($noticia['title'], 100), ['controller' => 'noticias', 'action' => 'view', $noticia['id'], \Cake\Utility\Inflector::slug(strtolower($noticia['title']))], array('escape' => false, 'style' => 'color:#0066ff')); ?>
                                    </h4>
                                    <p>
                                        <cite>
                                            <?php
                                            echo $this->Strings->abreviar($noticia['subtitle'], 80);
                                            ?>
                                        </cite>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-lg-3">
        <div class="hidden-xs">
            <div class="sidebar-module">
                <div class="row">
                    <div class="col-lg-12">
                        <h5>PUBLICAÇÕES</h5>                                    
                    </div>
                </div>
                <div class="navbar navbar-default">
                    <ul class="nav nav-pills nav-stacked">
                        <?php foreach ($lista_usuarios as $lu): ?>
                            <li>
                                <?php echo $this->Html->link($lu['name'], ['controller' => 'noticias', 'action' => 'autor', $lu['id'], \Cake\Utility\Inflector::slug(strtolower($lu['name']))], array('escape' => false)); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>