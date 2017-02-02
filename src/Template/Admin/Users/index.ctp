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
                        <?php foreach ($list_users as $user): ?>
                            <tr>
                                <td><?= $user['id']; ?></td>
                                <td><?= $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', ['controller' => 'users', 'action' => 'edit', $user['id']], array('escape' => false)); ?></td>
                                <td>
                                <?= $user['active'] == 1 ? '<span class="glyphicon glyphicon-ok"></span>' : ''; ?>
                                </td>
                                <td><?= $user['name']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['role']; ?></td>
                                <td><?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', array('controller' => 'users', 'action' => 'delete', $user['id']), array('escape' => false, 'confirm' => 'Deseja Realmente excluir esse registro?')); ?></td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>                                        
                </table>
            </div>            
        </div>
        <div class="row">
            <div class="col-lg-12" >
                <?php echo $this->Html->link('Novo', ['controller' => 'users', 'action' => 'add'], array('class' => 'btn btn-default')); ?>
            </div>
        </div>
    </div>
</div>