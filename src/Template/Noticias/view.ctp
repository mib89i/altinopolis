<style type="text/css">
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
        .carousel {width: 500px}
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
<?= $this->Html->css('pgwslideshow.min.css'); ?> 
<div class="row">
    <div class="col-lg-12">
        <div itemscope="">
            <article id="news">
                <header itemprop="headline">
                    <h1>
                        <?php echo $this->Html->link($noticias->title, ['controller' => 'noticias', 'action' => 'view', $noticias->id, \Cake\Utility\Inflector::slug(strtolower($noticias['title']))], array('escape' => false)); ?>
                    </h1>                    
                    <div itemprop="category">
                        <?= $noticias['categoria']['name']; ?>
                    </div>
                    <div itemprop="author">
                        <strong>
                            <?php echo $this->Html->link($noticias['user']['name'], ['controller' => 'noticias', 'action' => 'autor', $noticias['user']['id'], \Cake\Utility\Inflector::slug(strtolower($noticias['user']['name']))], ['style' => 'color:black']); ?>
                        </strong>
                    </div>
                    <br />
                    <time datetime="dd/mm/yyyy">
                        Altinópolis, <?= $noticias->created; ?>
                    </time>
                </header>
                <br />
                <div class="content" itemprop="articleBody">
                    <?= $noticias->text; ?>
                </div>
            </article>            
        </div>
    </div>
</div>
<!-- 
<a class="news-title" href="<?php // '/img/albuns/' . $imagem2['gallery_id'] . '/' . $imagem2['name'];  ?>" target="_blank">
</a> -->
<?php if ($noticias['gallery_id'] !== NULL) { ?>
    <ul class="pgwSlideshow">
        <?php foreach ($noticias['album']['imagens'] as $imagem2): ?>
            <li>
                <?= $this->Html->image('albuns/' . $imagem2['gallery_id'] . '/' . $imagem2['name']); ?>
            </li>
        <?php endforeach; ?>    
    </ul>
<?php } ?>
<?= $this->Html->script('pgwslideshow.min.js'); ?> 
<script>
    // http://pgwjs.com/pgwslideshow/
    // https://github.com/Pagawa/PgwSlideshow
    $(document).ready(function () {
        var pgwSlideshow = $('.pgwSlideshow').pgwSlideshow();
        pgwSlideshow.reload({
            autoSlide: false,
            maxHeigth: 350
        });
    });
</script>