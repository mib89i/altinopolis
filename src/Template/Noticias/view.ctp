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
                            <?= $noticias['user']['name']; ?>
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
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom: 10px">
    <!-- Indicators -->
    <div class="carousel-indicators">
        <?php $i = 0; ?>
        <?php foreach ($noticias['album']['imagens'] as $imagem2): ?>
        <span href="#" data-target="#myCarousel" data-slide-to="<?= $i; ?>" class="<?= ($i === 0 ) ? 'active' : ''; ?>" style="cursor: pointer">
                <?= $this->Html->image('albuns/' . $imagem2['gallery_id'] . '/' . $imagem2['name'], ['class' => 'img-rounded', 'width' => '50', 'height' => '50']); ?>
            </span >
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php $i = 0; ?>
        <?php foreach ($noticias['album']['imagens'] as $imagem2): ?>
            <div class="item <?= ($i === 0 ) ? 'active' : ''; ?> ">
                <?= $this->Html->image('albuns/' . $imagem2['gallery_id'] . '/' . $imagem2['name']); ?>                            
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