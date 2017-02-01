    <?= $this->Form->create($categorias) ?>
    <div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">Categorias</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                         <?= $this->Form->input('name', array('label'=>'', 'class'=>'form-control','maxlenght'=>'150','placeholder'=>'Descrição...')) ?>
                    </div>
			        <div class="row">
			        	<div class="col-lg-4 col-md-4 col-sm-4" >
			        		<?= $this->Form->submit('Salvar', array('class' => 'btn btn-default btn-block', 'title' => 'Salvar')); ?>
			        	</div>
			        	<div class="col-lg-4 col-md-4 col-sm-4" >
			        		<?php echo $this->Html->link('Voltar', ['controller' => 'categorias'], array('class'=>'btn btn-default btn-block')); ?>
			        	</div>
			        	<div class="col-lg-4 col-md-4 col-sm-4" >
			        		<?php echo $this->Html->link('Novo', ['controller' => 'categorias', 'action'=>'add'], array('class'=>'btn btn-default btn-block')); ?>
			        	</div>
			        </div>
                </div>               
            </div>
        </div>
       
    </div>
    <?= $this->Form->end() ?>