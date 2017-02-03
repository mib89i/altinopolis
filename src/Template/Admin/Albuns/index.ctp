<br />
<div class="row">
    <div class="large-8 columns">
        <h4>Lista de Álbuns</h4>
    </div>

    <div class="large-4 columns">
        <?php echo $this->Html->link('Novo Álbum', array('controller' => 'albuns', 'action' => 'add'), array('class' => 'button small radius alert right', 'style' => 'font-weight: bold')); ?>
    </div>
</div>

<div class="row">
    <?php 
    foreach ($lista_albuns as $album): ?>
	<div class="small-6 medium-4 large-3 columns left">
		<div class="panel radius">
		    <h6>
		    	<?php $name_image = $this->Strings->abreviar($album['name'], 23); ?>
		    	<?php echo $this->Html->link($name_image, array('controller' => 'albuns', 'action' => 'edit/'.$album['id']), array('style' => 'font-size: 10pt; font-weight: bold')); ?>
		    </h6>
		    
		    <?php  
		    if ($album['capa'] != NULL): ?>
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
		    <br /><br />
				<?php echo $this->Form->postLink('Excluir Álbum', array('controller' => 'albuns', 'action' => 'delete', $album['Album']['id']), array('confirm' => 'Deseja Realmente excluir esse Álbum?', 'style' => 'float: right; font-size: 8pt'));  ?>
		</div>	
	</div>    
	<?php endforeach; ?>
    
</div>



