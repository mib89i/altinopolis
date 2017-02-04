<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Notícias</h1>
        <div class="row">            
            <div class="col-lg-12">
                <table class="table table-responsive table-striped" style="margin-top: 15px">
                    <thead>
                        <tr>
                            <th width="15">#</th>
                            <th width="15"></th>
                            <th>Descrição</th>
                            <th>Usuário</th>
                            <th width="15"></th>
                        </tr>
                    </thead>
                    <tbody>	
			<?php foreach ($lista_noticias as $noticia): ?>

                        <tr>

                            <td><?= $noticia['id']; ?></td>
                            <td><?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', ['controller' => 'categorias', 'action' => 'edit', $noticia['id']], array('escape' => false)); ?></td>
                            <td><?= $noticia['title']; ?></td>
                            <td><?= $noticia['Users']; ?></td>
                            <td><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', array('controller' => 'noticias', 'action' => 'delete', $noticia['id']), array('escape' => false, 'confirm' => 'Deseja Realmente excluir essa notícia?')); ?></td>

                        </tr>
                    </tbody>
            <?php endforeach; ?>                                        

                </table>                                

            </div>            
        </div>
        <div class="row">
            <div class="col-lg-12" >
        		<?php echo $this->Html->link('Novo', ['controller' => 'noticias', 'action'=>'add'], array('class'=>'btn btn-default')); ?>
            </div>
        </div>
    </div>
</div>