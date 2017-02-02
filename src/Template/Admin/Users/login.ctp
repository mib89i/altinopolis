<style type="text/css">
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
    }
</style>

<div class="container">
    <div class="form-signin">
        <h2 class="form-signin-heading">Login</h2>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Flash->render() ?>
        <?= $this->Form->create() ?>
        <fieldset>
            <?php echo $this->Form->input('username', array('label' => '', 'placeholder' => 'Usuário', 'class' => 'error input-block-level', 'required')); ?>
            <?php echo $this->Form->input('password', array('label' => '', 'placeholder' => 'Senha', 'class' => 'error input-block-level', 'required')); ?>
        </fieldset> 
        <?= $this->Form->button(__('ENTRAR'), array('class' => 'btn btn-large btn-primary')); ?>
        <span style="margin-left: 15px!important">
            <a href="#">Esqueci minha senha</a>
        </span>
        <?= $this->Form->end() ?>
    </div>
</div> <!-- /container -->