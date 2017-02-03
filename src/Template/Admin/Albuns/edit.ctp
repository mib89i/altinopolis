<br />
<div class="row">
    <div class="large-8 columns">
        <h4>Editar Álbum</h4>
    </div>

    <div class="large-4 columns">
        <?php echo $this->Html->link('Lista de Álbuns', array('controller' => 'albuns', 'action' => 'index'), array('class' => 'button small radius alert right', 'style' => 'font-weight: bold')); ?>
    </div>
</div>


<div class="row">
    <div class="large-12 columns">
        <?php echo $this->Form->create($album, ['enctype' => 'multipart/form-data']); ?>
        <div class="panel radius">
            <div class="row">
                <div class="large-4 columns">
                <label>Capa do Álbum</label>
                <br />
                <?php 
                	if ($album['picture_id'] != NULL){
                        echo $this->Html->image('albuns/' . $album['id'] .'/'. $album['capa']['name'], array("alt" => "Capa do Álbum"));
                    } else if (empty($this->request->data['Imagem'])){
                        echo $this->Html->image('gallery_empty.png', array("alt" => "Capa do Álbum", 'width' => '500'));
                    } else {
                        echo $this->Html->image('albuns/' . $album['id'] .'/'.$this->request->data['Imagem'][0]['name'], array("alt" => "Capa do Álbum"));
                    }
                ?>
                </div>
                <div class="large-8 columns">
                <?php 
                    echo $this->Form->input('name', array('label' => 'Nome'));
                    echo $this->Form->input('description', array('label' => 'Descrição'));
                    echo $this->Form->input('uploaded_file[]', array('type' => 'file', 'multiple' => true, 'label' => 'Fotos do Álbum'));
                    echo $this->Form->submit('Salvar', ['class' => 'btn btn-default', 'title' => 'Salvar']);
                ?>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<?php $index = 0; ?>
<div class='row'>
    <div class="large-12 columns">
        <ul class="clearing-thumbs small-block-grid-4">

        <?php 
        foreach ($lista_imagens as $imagem): ?>
            <?php 
                $capa = FALSE;
                $index++;
                if ($imagem['id'] == $album->picture_id){
                    $capa = TRUE;
                }
            ?>

            <li onmouseover="document.getElementById('i_capa<?php echo $index; ?>').style.visibility = '';"
                onmouseout="document.getElementById('i_capa<?php echo $index; ?>').style.visibility = 'hidden';">
                <?php echo $this->Html->image('albuns/' . $album['id'] .'/thumb_'.$imagem['name'], [
                    "alt" => "Imagem do Álbum", 
                    "class" => "th",
                    'url' => '/img/albuns/'.$album->id .'/'. $imagem['name'],
                    'width' => '500',
                    'target' => '_BLANK'
                ]);
                ?>

                <?php 
                    echo $this->Form->postLink('Definir Capa', 
                        array('controller' => 'albuns', 'action' => 'capa_img', $imagem['id']), array('confirm' => 'Definir essa Imagem como Capa do Álbum?','id' => 'i_capa'.$index, 'style' => 'float: left; font-size: 10pt; visibility: hidden; background: white; font-weight: bold'))
                    ;
                ?>
                <?php 
                    echo $this->Form->postLink('Excluir esta Imagem', 
                        array('controller' => 'albuns', 'action' => 'delete_img', $imagem['id']), array('confirm' => 'Deseja Realmente excluir essa Imagem?', 'style' => 'float: right; font-size: 10pt; background: white; font-weight: bold'))
                    ;
                ?>
            </li>
            
        <?php endforeach; ?>
        </ul>
    </div>
</div>