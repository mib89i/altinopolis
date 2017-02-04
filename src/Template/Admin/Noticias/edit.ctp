<?= $this->Form->create($noticias) ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Noticias</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form_noticias"  method="post">
                            <div class="form-group">
                                <label>Publicação</label>
                                <?= $this->Form->input('publish', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Data...', '' => '', 'type' => 'date')) ?>
                            </div>
                            <div class="form-group">
                                <label>Categoria</label>
                                <?php
                                    echo $this->Form->select('category_id', $lista_categoria, ['empty' => false, 'label'=>'Categorias', 'class'=>'form-control']);
                                ?>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->input('title', array('label' => 'Titulo', 'class' => 'form-control', 'placeholder' => 'Titulo...')) ?>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->input('subtitle', array('label' => 'Subtitulo', 'class' => 'form-control', 'placeholder' => 'Texto em...', 'maxlenght' => '150', 'rows' => '3', 'style="overflow:nome"')) ?>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->input('text', array('label' => 'Texto', 'name' => 'editor1', 'id' => 'editor1', 'class' => 'form-control', 'placeholder' => 'Texto em...', 'id' => 'editor1', 'maxlenght' => '5000')) ?>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->input('video_url', array('label' => 'Incoporar Vídeo', 'class' => 'form-control', 'placeholder' => 'Url de incoporação...', '' => '', 'type' => 'url')) ?>
                            </div>

                            <div class="form-group">
                                <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe width="854" height="480" src="https://www.youtube.com/embed/UMhskLXJuq4" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>                 
                            <div class="form-group">
                                <label>Publicar em</label>
                                <?= $this->Form->input('schedule', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Data...', '' => '', 'type' => 'date')) ?>
                            </div>
                            <div class="form-group">
                                <?=
                                $this->Form->input('checkbox', array(
                                    'label' => 'Ativar',
                                    'type' => 'checkbox',
                                    'style' => 'font-weight:bold',
                                    'format' => array('before', 'input', 'between', 'label', 'after', 'error')
                                ));
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <?= $this->Form->submit('Salvar', ['class' => 'btn btn-default btn-block', 'title' => 'Salvar']); ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <?php echo $this->Html->link('Voltar', ['controller' => 'noticias'], array('class' => 'btn btn-default btn-block')); ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <?php echo $this->Html->link('Novo', ['controller' => 'noticias', 'action' => 'add'], array('class' => 'btn btn-default btn-block')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor1');
</script>
<?= $this->Form->end() ?>