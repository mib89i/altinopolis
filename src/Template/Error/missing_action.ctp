<div class="row">
    <div class="col-lg-12">
        <h1 style="text-align: center">AÇÃO NÃO ENCONTRADA!</h1>        
    </div>
</div>
<?php
echo $this->Form->create(false, array(
    'url' => '/noticias/find',
    'type' => 'get',
    'class' => 'navbar-form navbar-left'
));
?>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <?= $this->Form->input('search', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Pesquisar...')); ?>            
        </div>
    </div>
</div>
<?= $this->Form->end() ?> 
