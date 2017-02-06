<style type="text/css">
    .hoverDiv {background: #fff;}
    .hoverDiv:hover {background: #f5f5f5;}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <h1>Pesquisar <?= $search; ?></h1>
            </div>
            <div class="col-lg-12">
                <form method="POST">
                    <div class="form-group">
                            <?php
                            echo $this->Form->create(false, array(
                                'url' => '/noticias/find',
                                'type' => 'get',
                            ));
                            ?>
                            <?= $this->Form->input('search', array('value'=>$search, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Pesquisar...')); ?>

                            <?= $this->Form->end() ?>
                    </div>
                </form>
            </div>
        </div>         
        <div class="row">
            <div class="col-lg-12 table-hover">
                <?php foreach ($lista_noticias as $noticia): ?>
                    <div class="row hoverDiv">
                        <?php if ($noticia['gallery_id'] !== NULL) { ?>
                            <div class="col-lg-2">

                            </div>
                        <?php } ; ?>
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