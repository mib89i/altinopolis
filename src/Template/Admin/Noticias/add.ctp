<?= $this->Form->create($noticias) ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Noticias</h1>
        <div class="row">
            <div class="col-lg-12">
                <form id="form_noticias"  method="post">
                    <div class="form-group">
                        <label>Publicação</label>
                         <?= $this->Form->input('publish', array('label'=>false, 'class'=>'form-control', 'placeholder'=>'Data...', ''=>'', 'type'=>'date')) ?>
                    </div>
                    <div class="form-group">				                
                        <label>Categoria</label>
                        <select class="form-control">
                            <option>Categoria 1</option>
                            <option>Categoria 2</option>
                            <option>Categoria 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('title', array('label'=>'Titulo', 'class'=>'form-control', 'placeholder'=>'Titulo...')) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('subtitle', array('label'=>'Subtitulo', 'class'=>'form-control', 'placeholder'=>'Texto em...', 'id'=>'editor1', 'maxlenght'=>'150', 'rows'=>'3', 'style="overflow:nome;"')) ?>
                    </div>
                    <div class="form-group">
                        <label>Texto</label>
                        <?= $this->Form->input('text', array('label'=>false, 'name'=>'editor1','class'=>'form-control', 'placeholder'=>'Texto em...', 'id'=>'editor1', 'maxlenght'=>'5000')) ?>
                    </div>
                    <div class="form-group">
                        <label>Incoporar Vídeo</label>
                        <input type="url" name="" class="form-control" placeholder="http://www.youtube.com/code" maxlength="150">
                        <?= $this->Form->input('video_url', array('class'=>'form-control', 'placeholder'=>'Url de incoporação...', ''=>'', 'type'=>'url')) ?>
                    </div>

                    <div class="form-group">
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="854" height="480" src="https://www.youtube.com/embed/UMhskLXJuq4" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>                 
                    <div class="form-group">
                        <label>Publicar em</label>
                        <?= $this->Form->input('schedule', array('label'=>false, 'class'=>'form-control', 'placeholder'=>'Data...', ''=>'', 'type'=>'date')) ?>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="i_active" name="">
                        <label for="i_active">Ativar</label>
                    </div>
                    <?= $this->Form->submit('Save', array('class' => 'submit')); ?>
                    <?= $this->Form->button(__('New')); ?>
                    <?= $this->Form->button(__('Delete')); ?>
                    <?= $this->Form->button(__('Find')); ?>
                    <input type="submit" name="delete" value="Excluir" class="btn btn-default">
                    <a href="pesquisar_noticias.html" class="btn btn-default">Pesquisar</a>
                </form>
                <form id="form_galeria"  method="post" enctype="multipart/form-data">
                    <div class="panel panel-default" style=" margin-top: 15px">
                        <div class="panel-heading"><strong>GALERIA</strong></div>
                        <div class="panel-body">...</div>
                        <div class="panel-footer">
                            <input type="file" accept="image/*" name="upload" value="Upload" class="btn btn-default">
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('editor1');
</script>
<?= $this->Form->end() ?>