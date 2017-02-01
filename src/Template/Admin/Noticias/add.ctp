<div class="users form">
    <?= $this->Form->create($preferencia) ?>
    <legend><?= __('Add User') ?></legend>
<div class="row">

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Noticias</h1>
        <div class="row">
            <div class="col-lg-12">
                <form id="form_noticias"  method="post">
                    <div class="form-group">
                        <label>Cadastro</label>
                        <input type="date" name="" value="1900-01-01" class="form-control" placeholder="Data...">
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
                        <label>Título</label>
                        <input type="text" name="" class="form-control" placeholder="Título..." maxlength="150">
                    </div>
                    <div class="form-group">
                        <label>Resumo</label>
                        <textarea name="" class="form-control" placeholder="Resumo..." maxlength="255" style="resize: none; "></textarea>
                    </div>
                    <div class="form-group">
                        <label>Texto</label>
                        <textarea id="editor1" name="editor1" maxlength="5000">Texto...</textarea>
                    </div>
                    <div class="form-group">
                        <label>Incoporar Vídeo</label>
                        <input type="url" name="" class="form-control" placeholder="http://www.youtube.com/code" maxlength="150">
                    </div>

                    <div class="form-group">
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="854" height="480" src="https://www.youtube.com/embed/UMhskLXJuq4" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>                 
                    <div class="form-group">
                        <label>Publicar em</label>
                        <input type="date" name="" value="1900-01-01" class="form-control" placeholder="Data...">
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

        
        
        
        
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?=
        $this->Form->input('role', [
            'options' => ['admin' => 'Administrador', 'comum' => 'Comum']
        ])
        ?>

<?= $this->Form->end() ?>
</div>