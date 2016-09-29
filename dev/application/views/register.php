<div class="container">
<div class="panel panel-default">
    <div class="signin">
        <div class="panel-heading">
            <h3 class="panel-title ">Registrar objeto</h3>
        </div>
        <div class="panel-body">
            <?php
                echo validation_errors();
                if(isset($error)){
                    echo $error;
                }
            ?>

            <form encytype="multipart/form-data" class="" action="<?=$action?>" method="POST">

                <?php foreach($form_model as $key => $value):
                    if($value['type']!='select'):
                    ?>

                    <div class="form-group">
                        <label for="user"><?=$key?></label>
                        <?php $value['class']='form-control';
                        echo form_input($value,set_value($value['name']));?>
                    </div>

                <?php
                    else:
                        ?>
                        <label for="user"><?=$key?></label>

                        <?php
                        echo form_dropdown($value['name'],$value['options'],set_value($value['name']));
                    endif;
            endforeach;?>

                <div class="container-fluid">
                    <div class="row form-group">
                        <button type="submit" class="btn btn-default pull-right">Confirmar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
