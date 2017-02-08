<?= 
$this->Form->create($noticias);
$this->Form->templates(
  ['dateWidget' => '{{day}}{{month}}{{year}}']
);
?>
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
                                <?= $this->Form->input('created', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Data...', '' => '', 'type' => 'date')) ?>
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
                                <?= $this->Form->input('text', array('label' => 'Texto', 'id' => 'editor1', 'class' => 'form-control', 'placeholder' => 'Texto em...', 'id' => 'editor1', 'maxlenght' => '5000')) ?>
                            </div>

                            <div class="form-group">
                                <label>Selecionar ou Criar um novo álbum</label>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row vertical-align">
                                            <div class="col-lg-1 col-sm-3">
                                                <?php 
                                                    if ($noticias['gallery_id'] === NULL) {
                                                        echo $this->Html->image('gallery_empty.png', ["alt" => "Álbum da Notícia", "class" => "img-responsive"]); 
                                                    } else {
                                                        if ($noticias['album']['capa']) {
                                                            echo $this->Html->image('albuns/'.$noticias['album']['id'].'/thumb_'.$noticias['album']['capa']['name'], ["alt" => "Álbum da Notícia", "class" => "img-responsive"]); 
                                                        } else {
                                                            echo $this->Html->image('gallery_empty.png', ["alt" => "Álbum da Notícia", "class" => "img-responsive"]); 
                                                        }
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-lg-11 col-sm-9">
                                                <?php if ($noticias['gallery_id'] === NULL) : ?>
                                                    <b><?php echo $this->Html->link('Selecionar Álbum para Notícia', 
                                                                    array('controller' => 'noticias', 'action' => 'selecionar_album_noticia', $noticias['id'])
                                                                );
                                                        ?>
                                                    </b>
                                                    <?php else: ?>
                                                        <h5><b><?php echo $noticias['album']['name'];?></b></h5>
                                                        <h6><?php echo $noticias['album']['description'];?></h6>
                                                        <?php echo $this->Html->link('Editar Álbum', ['controller' => 'noticias', 'action' => 'selecionar_album_noticia/'.$noticias['id'].'/'.'true'], ['class' => 'btn btn-default btn-xs']); ?>
                                                        <?php echo $this->Html->link('Alterar Álbum', ['controller' => 'noticias', 'action' => 'selecionar_album_noticia', $noticias['id']], ['class' => 'btn btn-xs btn-primary']); ?>
                                                        <?php echo $this->Html->link('Remover', ['controller' => 'noticias', 'action' => 'remover_album_noticia', $noticias['id']], ['class' => 'btn btn-xs btn-danger']); ?>
                                                    <?php endif; ?>
                                                
                                            </div>
                                        </div>
                                    </div>                                        
                                </div>
                            </div>

                            <div class="form-group">
                                <?= $this->Form->input('video_url', array('label' => 'Incoporar Vídeo', 'class' => 'form-control', 'placeholder' => 'Url de incoporação...', '' => '', 'type' => 'url')) ?>
                            </div>

                            <div class="form-group">
                                <label>Publicar em</label>
                                <?= $this->Form->input('schedule', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Data...', '' => '', 'type' => 'date')) ?>
                            </div>
                            <div class="form-group">
                                <?=
                                $this->Form->input('main', array(
                                    'label' => 'Principal',
                                    'type' => 'checkbox'
                                ));
                                ?>
                            </div>
                            <div class="form-group">
                                <?=
                                $this->Form->input('active', array(
                                    'label' => 'Ativar',
                                    'type' => 'checkbox'
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