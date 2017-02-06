<div class="row">
    <div class="col-lg-12">
        <div itemscope="">
            <article id="news">
                <header itemprop="headline">
                    <h1>
                        <?php echo $this->Html->link($noticias->title, ['controller' => 'noticias', 'action' => 'view', $noticias->id, \Cake\Utility\Inflector::slug(strtolower($noticia['title']))], array('escape' => false)); ?>
                    </h1>
                    <div itemprop="category">
                          <?= $categoria->name; ?>
                    </div>
                    <div itemprop="author">
                        <strong>
                            <?= $usuario->name; ?>
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