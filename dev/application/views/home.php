<div class="container">
    <div class="jumbotron">
        <h1>Lost & Found</h1>
        <p>O sistema Lost & Found tem o objetivo de ajudar as pessoas encontrarem seus pertences perdidos.</p>
        <p>Pode ser implementado em qualquer lugar pois é free!</p>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <a href='objectregister' class='col-md-offset-4 btn btn-danger btn-lg'> Perdeu algo ?</a>
            </div>
            <?php if(!$login):?>
            <div class="col-md-6">
                <a href='signin' class='col-md-offset-4 btn btn-success btn-lg'> Criar conta</a>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
