<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Álbuns</h1>
        <div class="row">            
        	<?php foreach ($lista_albuns as $album): ?>
        		<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="panel panel-default">
					  	<div class="panel-heading">
							<h6 class="panel-title">
						    	<?php $name_image = $this->Strings->abreviar($album['name'], 23); ?>
						    	<?php echo $this->Html->link($name_image, array('controller' => 'albuns', 'action' => 'edit/'.$album['id']), array('style' => 'font-size: 10pt; font-weight: bold')); ?>
						    </h6>
					  	</div>

					 	<div class="panel-body">
					 		<div class="text-center">
					    	<?php  if ($album['capa'] != NULL): ?>
								<?php 
									echo $this->Html->image( 'albuns/' . $album['id'] .'/thumb_'. $album['capa']['name'], [
										'alt' => 'Capa do Álbum',
										'width'=> '200',
										'url' => ['controller' => 'albuns', 'action' => 'edit', $album['id']]
									]);				
								?>
							<?php else: ?>
								<?php 
									echo $this->Html->image('gallery_empty.png', [
									    'alt' => 'Álbum sem Imagens', 
									    'width'=> '200', 
									    'url' => ['controller' => 'albuns', 'action' => 'edit', $album['id']]
									]);
								?>
						    <?php endif; ?>
						    </div>
						    
								<?php echo $this->Form->postLink('Excluir Álbum', array('controller' => 'albuns', 'action' => 'delete', $album['id']), array('confirm' => 'Deseja Realmente excluir esse Álbum?', 'style' => 'float: right; font-size: 8pt'));  ?>
					  	</div>
					</div>				
				</div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="large-4 columns">
        <?php echo $this->Html->link('Novo Álbum', array('controller' => 'albuns', 'action' => 'add'), array('class' => 'button small radius alert right', 'style' => 'font-weight: bold')); ?>
    </div>
</div>


