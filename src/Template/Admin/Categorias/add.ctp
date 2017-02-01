<div class="categorias form">
    <?= $this->Form->create($categorias) ?>
    <legend><?= __('Add User') ?></legend>
    <div class="row">

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Categorias</h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Categoria</label>
                        <input type="text" name="" class="form-control" placeholder="Descrição...">
                    </div>
                    <?= $this->Form->submit('Save', array('class' => 'btn btn-default', 'title' => 'Salvar')); ?>
                </div>
                <div class="col-lg-6">
                    <h3>LISTA</h3>
                    <table class="table table-responsive" style="margin-top: 15px">
                        <tr>
                            <td>#</td>
                            <td><a href="categorias.html?editar=1" class="glyphicon glyphicon-edit"></a></td>
                            <td>Nome</td>
                            <td>Login</td>
                            <td>Status</td>
                        </tr>
                    </table>
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