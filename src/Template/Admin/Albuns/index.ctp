<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
        	Álbuns
        	<?php echo $this->Html->link('Novo Álbum', array('controller' => 'albuns', 'action' => 'add'), array('class' => 'btn btn-default', 'style' => 'float: right')); ?>
        		
    	</h1>
        <div class="row">            
        	<?php foreach ($lista_albuns as $album): ?>
        		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="panel panel-default">
					  	<div class="panel-heading">
							<h6 class="panel-title">
						    	<?php $name_image = $this->Strings->abreviar($album['name'], 30); ?>
						    	<?php echo $this->Html->link($name_image, array('controller' => 'albuns', 'action' => 'edit/'.$album['id']), array('style' => 'font-size: 10pt; font-weight: bold')); ?>
						    </h6>
					  	</div>

					 	<div class="panel-body">
					 		<div class="text-center">
					    	<?php  if ($album['capa'] != NULL): ?>
								<?php 
									echo $this->Html->image( 'albuns/' . $album['id'] .'/thumb_'. $album['capa']['name'], [
										'alt' => 'Capa do Álbum',
										'class'=> 'img-relative',
										'url' => ['controller' => 'albuns', 'action' => 'edit', $album['id']]
									]);				
								?>
							<?php else: ?>
								<?php 
									echo $this->Html->image('gallery_empty.png', [
									    'alt' => 'Álbum sem Imagens', 
									    'class'=> 'img-relative', 
									    'url' => ['controller' => 'albuns', 'action' => 'edit', $album['id']]
									]);
								?>
						    <?php endif; ?>
						    </div>
						    
								<?php // echo $this->Form->postLink('Excluir Álbum', array('controller' => 'albuns', 'action' => 'delete', $album['id']), array('confirm' => 'Deseja Realmente excluir esse Álbum?', 'style' => 'float: right; font-size: 8pt'));  ?>
					  	</div>
					</div>				
				</div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


