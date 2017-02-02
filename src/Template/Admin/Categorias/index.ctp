<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Categorias</h1>
        <div class="row">            
            <div class="col-lg-12">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th width="15">#</th>
                            <th width="15"></th>
                            <th>Descrição</th>
                            <th width="15"></th>
                        </tr>
                    </thead>
                    <tbody>	
                        <?php foreach ($lista_categoria as $categoria): ?>
                            <tr>
                                <td><?= $categoria['id']; ?></td>
                                <td><?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', ['controller' => 'categorias', 'action' => 'edit', $categoria['id']], array('escape' => false)); ?></td>
                                <td><?= $categoria['name']; ?></td>
                                <td><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', array('controller' => 'categorias', 'action' => 'delete', $categoria['id']), array('escape' => false, 'confirm' => 'Deseja Realmente excluir essa Categoria?')); ?></td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>                                        
                </table>
            </div>            
        </div>
        <div class="row">
            <div class="col-lg-12" >
                <?php echo $this->Html->link('Novo', ['controller' => 'categorias', 'action' => 'add'], array('class' => 'btn btn-default')); ?>
            </div>
        </div>
    </div>
</div>