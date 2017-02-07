<style type="text/css">
    .panel-transparent {
        background: rgba(46, 51, 56, 0.2)!important;
    }
    }
</style>
<div class="row">
    <div class="col-sm-9">
        <div class="row">
            <div class="col-lg-8">

                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom: 10px">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="http://www.w3schools.com/bootstrap/img_chania.jpg" alt="Chania" class="img-responsive">
                            <div class="carousel-caption panel-transparent">
                                <h1>
                                    <a href="#">
                                        Chania
                                    </a>
                                </h1>
                                <p>Notícia......</p>
                            </div>                    
                        </div>

                        <div class="item">
                            <img src="http://www.w3schools.com/bootstrap/img_chania.jpg" alt="Chania" class="img-responsive">
                        </div>

                        <div class="item">
                            <img src="http://www.w3schools.com/bootstrap/img_flower.jpg" alt="Chania" class="img-responsive">
                        </div>

                        <div class="item">
                            <img src="http://www.w3schools.com/bootstrap/img_flower2.jpg" alt="Chania" class="img-responsive">
                        </div>
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
            <div class="col-lg-4">
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
                    <?php /*debug($noticia);*/?>
                        <div class="col-lg-4" style="height: 150px">
                            <div class="row">
                                <?php if ($noticia['gallery_id'] !== NULL) { ?>
                                    <div class="col-lg-4">
                                        <?=$this->Html->image('albuns/' . $noticia['album']['id'] . '/' . 'thumb_' . $noticia['album']['capa']['name'], ['class'=>'img-responsive', 'alt'=>'', 'style'=>'width: 100%; height: auto; ']); ?>
                                    </div>
                                <?php } ?>
                                <div class="<?= ($noticia['gallery_id'] !== NULL) ? 'col-lg-8' : 'col-lg-12'; ?>">
                                    <h4 style="text-align: justify">
                                        <?php echo $this->Html->link($this->Strings->abreviar($noticia['title'], 100), ['controller' => 'noticias', 'action' => 'view', $noticia['id'], \Cake\Utility\Inflector::slug(strtolower($noticia['title']))], array('escape' => false, 'style' => 'color:#0066ff')); ?>
                                    </h4>
                                    <p style=" text-align: justify;">
                                        <cite>
                                            <?php
                                            echo $this->Strings->abreviar($noticia['text'], 80);
                                            ?>
                                        </cite>
                                        ...</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-sm-3">
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