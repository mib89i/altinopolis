<style type="text/css">
    .hoverDiv {background: #fff;}
    .hoverDiv:hover {background: #f5f5f5;}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="row page-header">
            <div class="col-lg-12">
                <h1>Pesquisar <?= $q; ?></h1>
            </div>
            <div class="col-lg-12">
                <?php
                echo $this->Form->create(false, [
                    'url' => ['controller' => 'noticias', 'action' => 'find']
                ]);
                ?>
                <?= $this->Form->input('search', array('value'=>$search, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Pesquisar...')); ?>

                <?= $this->Form->end() ?>
            </div>
        </div>         
        <div class="row">
            <div class="col-lg-12 table-hover">
                <?php foreach ($lista_noticias as $noticia): ?>
                    <div class="row hoverDiv">
                        <?php if ($noticia['gallery_id'] !== NULL) { ?>
                            <div class="col-lg-2">

                            </div>
                        <?php } ?>
                        <div class="col-lg-10">
                            <?php echo $this->Html->link("<h3>" . $noticia['title'] . "</h3>", ['controller' => 'noticias', 'action' => 'view', $noticia['id']], array('escape' => false)); ?>
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