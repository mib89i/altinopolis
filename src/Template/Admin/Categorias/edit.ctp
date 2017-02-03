    <?= $this->Form->create($categoria) ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar - Categoria</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                         <?= $this->Form->input('name', array('label'=>'', 'class'=>'form-control','maxlenght'=>'150','placeholder'=>'Descrição...')) ?>
                    </div>
                    <div class="row">
			        	<div class="col-sm-1" >
			        		<?= $this->Form->submit('Alterar', array('class' => 'btn btn-default', 'title' => 'Alterar')); ?>
			        	</div>
			        	<div class="col-sm-1" >
			        		<?php echo $this->Html->link('Voltar', ['controller' => 'categorias'], array('class'=>'btn btn-default')); ?>
			        	</div>
			        </div> 
                </div>                
            </div>
        </div>       
    </div>
    <?= $this->Form->end(); ?>