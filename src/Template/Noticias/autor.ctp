
<style type="text/css">
    .hoverDiv {background: #fff;}
    .hoverDiv:hover {background: #f5f5f5;}
    .panel-transparent {
        background: rgba(46, 51, 56, 0.2)!important;
    }
    .img-news .img-responsive {
        margin: 0 auto;
    }    
    .min-height-200 { min-height: 180px;} 
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
        filter: alpha(opacity=70); /* For IE8 and earlier */          
        background: white;
        border-radius: 5px;
    }
    
    .news-title {
        opacity: 1;
        filter: alpha(opacity=100); /* For IE8 and earlier */            
        color: black;
        padding: 5px;
    }
    
    .carousel-caption {
        
    }   
</style>    
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <h1><?=$usuario_nome;?></h1>
                <h5 style="margin-top: 25px">Pesquisar por <?= $search; ?></h5>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                        <?php
                        echo $this->Form->create(false, array(
                            'url' => "/noticias/autor/$usuario_id/" . \Cake\Utility\Inflector::slug($usuario_nome) . "/",
                            'type' => 'get',
                        ));
                        ?>
                        <?= $this->Form->input('search', array('value'=>$search, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Pesquisar...')); ?>

                        <?= $this->Form->end() ?>
                </div>
            </div>
        </div>         
        <div class="row">
            <div class="col-lg-12 table-hover">
                <?php foreach ($lista_noticias as $noticia): ?>
                    <div class="row hoverDiv">
                        <div class="col-lg-10">
                            <h3>
                                <?php echo $this->Html->link($noticia['title'], ['controller' => 'noticias', 'action' => 'view', $noticia['id'], \Cake\Utility\Inflector::slug(strtolower($noticia['title']))], array('escape' => false)); ?>
                            </h3>
                            <p style=" text-align: justify;">
                                <cite>
                                    <strong><?= $noticia['created']; ?></strong>
                                    <?php
                                    try {
                                        echo substr($noticia['text'], 0, 255);
                                    } catch (Exception $ex) {
                                        echo $noticia['text'];
                                    }
                                    ?>
                                </cite>
                                ...</p>
                            <time datetime="<?= $noticia['publish']; ?>">
                                <strong><?= $noticia['publish']; ?></strong>
                            </time>
                        </div> 
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".hoverDiv").hover(function () {
            $(this).css("background", "#f5f5f5");
        }, function () {
            $(this).css("background", "#fff");
        });
    });
</script>