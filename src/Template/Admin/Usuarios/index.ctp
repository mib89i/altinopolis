<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Usuários</h1>
        <div class="row">            
            <div class="col-lg-12">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th width="15">#</th>
                            <th width="15"></th>
                            <th width="15">Ok</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Nível</th>
                            <th width="15"></th>
                        </tr>
                    </thead>
                    <tbody>	
                        <?php foreach ($lista_usuarios as $usuario): ?>
                            <tr>
                                <td><?= $usuario['id']; ?></td>
                                <td><?= $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', ['controller' => 'usuarios', 'action' => 'edit', $usuario['id']], array('escape' => false)); ?></td>
                                <td>
                                <?= $usuario['active'] == 1 ? '<span class="glyphicon glyphicon-ok"></span>' : ''; ?>
                                </td>
                                <td><?= $usuario['name']; ?></td>
                                <td><?= $usuario['username']; ?></td>
                                <td><?= $usuario['role']; ?></td>
                                <td><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', array('controller' => 'usuarios', 'action' => 'delete', $usuario['id']), array('escape' => false, 'confirm' => 'Deseja Realmente excluir esse registro?')); ?></td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>                                        
                </table>
            </div>            
        </div>
        <div class="row">
            <div class="col-lg-12" >
                <?php echo $this->Html->link('Novo', ['controller' => 'usuarios', 'action' => 'add'], array('class' => 'btn btn-default')); ?>
            </div>
        </div>
    </div>
</div>