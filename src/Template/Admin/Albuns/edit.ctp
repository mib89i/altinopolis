<?php echo $this->Form->create($album, ['id' => 'form_album', 'type' => 'file']); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <?php echo $this->Form->input('name', ['label' => false, 'placeholder' => 'Nome do Álbum', 'class' => 'form-control input-lg', 'style' => 'font-size: 15pt; font-weight: bold']); ?>
        </div>
            <div class="row">
                <div class="col-lg-12">
                <?php echo $this->Form->input('description', ['label' => false, 'placeholder' => 'Descrição do Álbum', 'rows' => '3', 'class' => 'form-control']); ?>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-2 col-xs-2">
                <?php echo $this->Html->link('Salvar', ['action' => '#'], ['class' => 'btn btn-default', 'title' => 'Salvar', 'data-toggle' => 'modal', 'data-target' => '#modal_salvar']); ?>
            </div>             
            <div class="col-lg-10 col-xs-10" style="text-align: right">
                <?php echo $this->Html->link('Voltar Para Álbuns', array('controller' => 'albuns', 'action' => 'index'), array('class' => 'btn btn-default')); ?>
                <label class="btn btn-default btn-file">
                   Adicionar Imagens ao Álbum<?php echo $this->Form->input('uploaded_file[]', ['id' => 'input_upload', 'label' => false, 'type' => 'file', 'multiple' => true]); ?>
                </label>
            </div>  
        </div>
    </div>  
</div>

<div id="modal_salvar" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">SALVAR ÁLBUM</h4>
            </div>
            <div class="modal-body">
                <p>Deseja realmente salvar este álbum?</p>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-3">
                    <?php echo $this->Form->submit('Salvar', ['class' => 'btn btn-primary btn-block', 'title' => 'Salvar']); ?>  
                    </div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Fechar</button>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<!--
CHAMADA VIA POSTLINK SEMPRE FORA DO FORM
-->
<div id="modal_excluir_imagem" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">EXCLUIR IMAGEM</h4>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir esta imagem?</p>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-3">
                    <?php 
                        echo $this->Form->postLink('Excluir', 
                            array('controller' => 'albuns', 'action' => 'delete_img', $imagem['id']), 
                            array('escape' => false),
                            array('confirm' => 'Deseja Realmente excluir essa Imagem?')
                        );
                    ?>
                    </div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Fechar</button>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_definir_capa" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">DEFINIR CAPA DO ÁLBUM</h4>
            </div>
            <div class="modal-body">
                <p>Deseja escolher esta imagem como capa do álbum?</p>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-3">
                    <?php 
                        echo $this->request->session()->read('imagem_capa_selecionada')['id'];
                        //echo $imagem_capa_selecionada['id'];
                        echo $this->Form->postLink('Definir Capa', 
                            array('controller' => 'albuns', 'action' => 'capa_img', $this->request->session()->read('imagem_capa_selecionada')['id']), 
                            //array('controller' => 'albuns', 'action' => 'capa_img', $imagem_capa_selecionada['id']), 
                            array('escape' => false, 'class' => 'btn btn-primary')
                        );
                    ?>
                    </div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Fechar</button>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-lg-12">
        <?php $index = 0; ?>
        <?php echo (empty($lista_imagens)) ? 'Este álbum esta vazio' : ''; ?>
        <div class="row">
            <?php foreach ($lista_imagens as $imagem): ?>
                <?php 
                    $index++;
                    $capa = FALSE;
                    if ($imagem['id'] == $album->picture_id){
                        $capa = TRUE;
                    }
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" 
                    onmouseover="document.getElementById('i_capa<?php echo $index; ?>').style.visibility = '';"
                    onmouseout="document.getElementById('i_capa<?php echo $index; ?>').style.visibility = 'hidden';">
                    <div class="panel panel-default" style="background: <?php echo ($capa) ? '#dff0d8' : ''?>">
                        <div class="panel-body">
                            <div class="text-center">
                                <?php echo $this->Html->image('albuns/' . $album['id'] .'/thumb_'.$imagem['name'], [
                                    "alt" => "Imagem do Álbum", 
                                    "class" => "img-responsive",
                                    'url' => '/img/albuns/'.$album->id .'/'. $imagem['name'],
                                ]);
                                ?>
                            </div>

                            <br />

                            <?php 
                                echo $this->Form->postLink('Definir Capa', 
                                    ['controller' => 'albuns', 'action' => 'capa_img', $imagem['id']], 
                                    ['confirm' => 'Definir esta imagem de Capa?', 'id' => 'i_capa'.$index, 'class' => 'btn btn-primary btn-xs', 'style' => 'float: left; visibility: hidden; font-weight: bold', 'title' => 'Capa do Álbum']
                                );
                            ?>

                            <?php 
                                echo $this->Form->postLink('Excluir', 
                                ['controller' => 'albuns', 'action' => 'delete_img', $imagem['id']], 
                                ['confirm' => 'Deseja Realmente excluir essa Imagem?', 'class' => 'btn btn-danger btn-xs', 'style' => 'float: right; font-weight: bold', 'title' => 'Excluir Imagem']
                                );
                            ?>
                        </div>
                    </div>                        
                </div>
            <?php endforeach; ?>    
        </div>  
    </div>  
</div>  
<hr />
<div class="row">
    <div class="col-lg-12">
        <?php echo $this->Form->postLink('Quero excluir este álbum', array('controller' => 'albuns', 'action' => 'delete', $album['id']), array('confirm' => 'Deseja Realmente excluir esse Álbum?', 'class' => 'btn btn-danger'));  ?>
    </div>
</div>

<div id="modal_aguarde" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <h4 style="padding: 20px; text-align: center">AGUARDE ...</h4>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    document.getElementById("input_upload").onchange = function() {
        open_modal_aguarde();
        document.getElementById("form_album").submit();
    };

    function open_modal_aguarde(){
        $('#modal_aguarde').modal('show');
    }

    // TEST POST VIA AJAX
    $('.post_ajax').on('click', function(e) {
        var href = this.href;
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: href,
            dataType: 'json',
            success: function(json) {
                console.log(json);
            }
        }); 
    });

</script>