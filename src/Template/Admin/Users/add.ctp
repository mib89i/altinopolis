<?= 
$this->Form->create($user);
$this->Form->templates(
  ['dateWidget' => '{{day}}{{month}}{{year}}']
);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Notícias</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Cadastro</label>
                    <?= $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'type' => 'date')) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->input('username', array('label' => 'Nome', 'class' => 'form-control', 'placeholder' => 'Nome...', '' => '', 'maxlenght' => '150')) ?>
                </div>                   
                <div class="form-group">
                    <?= $this->Form->input('username', array('label' => 'Login', 'class' => 'form-control', 'placeholder' => 'Login...', '' => '', 'maxlenght' => '100')) ?>
                </div>                   
                <div class="form-group">
                    <?= $this->Form->input('password', array('label' => 'Password', 'class' => 'form-control', 'placeholder' => 'Login...', '' => '', 'maxlenght' => '100')) ?>
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