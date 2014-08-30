<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3>Gerenciador de Domínios</h3>
                    <h3 class="panel-title">Por favor identifique-se</h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo ROOT_URL; ?>auth/login" method="POST" role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="username" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password">
                            </div>
                            <button class="btn btn-lg btn-success btn-block">Entrar</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>