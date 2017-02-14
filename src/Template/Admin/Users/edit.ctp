<?= 
$this->Form->create($user);
//$this->Form->templates(
//  ['dateWidget' => '{{day}}{{month}}{{year}}']
//);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Editar Usuário</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <?= $this->Form->input('name', array('label' => 'Nome', 'class' => 'form-control', 'placeholder' => 'Nome', 'maxlenght' => '150')) ?>
                </div>                   

                <div class="form-group">
                    <?= $this->Form->input('username', array('label' => 'Login', 'class' => 'form-control', 'placeholder' => 'Login', 'maxlenght' => '100')) ?>
                </div> 

                <div class="form-group">
                    <label>Nível</label>
                    <?=
                    $this->Form->input('role', ['label' => false,
                        'options' => ['admin' => 'Administrador', 'comum' => 'Comum'],
                        'class' => 'form-control'
                    ])
                    ?>
                </div>

                <?php echo $this->Html->link('<span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Alterar a Senha', ['action' => '#'], ['class' => 'btn btn-default', 'title' => 'Alterar a Senha', 'data-toggle' => 'modal', 'data-target' => '#alterar_senha', 'escape'=>false]); ?>
            </div>
        </div>
        <div class="row" style="margin-top: 15px">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <?= $this->Form->submit('Salvar', ['class' => 'btn btn-default btn-block', 'title' => 'Salvar']); ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php echo $this->Html->link('Voltar', ['controller' => 'users'], array('class' => 'btn btn-default btn-block')); ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php echo $this->Html->link('Novo', ['controller' => 'users', 'action' => 'add'], array('class' => 'btn btn-default btn-block')); ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>


<div id="alterar_senha" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= $this->Form->create($user, [
                'url' => ['controller' => 'Users', 'action' => 'alterar_senha', $user['id']]
            ]); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alterar Senha</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <?= $this->Form->input('new_password', array('type' => 'password', 'label' => 'Nova Senha', 'class' => 'form-control', 'placeholder' => 'Digite uma Nova Senha', 'maxlenght' => '100')) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->input('confirm_password', array('type' => 'password', 'label' => 'Confirme a Nova Senha', 'class' => 'form-control', 'placeholder' => 'Confirme a Nova Senha', 'maxlenght' => '100')) ?>
                </div>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-3">
                    <?php echo $this->Form->submit('Alterar', ['class' => 'btn btn-primary btn-block', 'title' => 'Alterar']); ?>  
                    </div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Fechar</button>                      
                    </div>
                </div>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
