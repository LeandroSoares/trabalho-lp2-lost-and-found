<div class="container">

    <div class="panel panel-default">
        <div class="signin">
            <div class="panel-heading">
                <h3 class="panel-title ">Sign in</h3>
            </div>
            <div class="panel-body">

                <form class="" action="<?=base_url('signin')?>" method="post">
                    <?php foreach($form_model as $key => $value): ?>
                        <div class="form-group">
                            <label for="user"><?=$key?></label>

                            <?php
                            $value['class']='form-control';
                            echo form_input($value);?>
                        </div>
                    <?php endforeach;?>
                    <!-- <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" name="pass" placeholder="username">
                    </div> -->


                    <div class="container-fluid">
                        <div class="row form-group">
                            <button type="submit" class="btn btn-default pull-right">Sign in</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
