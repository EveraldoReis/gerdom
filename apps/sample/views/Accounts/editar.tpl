
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Editar dados de acesso</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form method="post" role="form">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input  required value="<?php echo $data->username; ?>" name="username" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input  required name="password" type="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>