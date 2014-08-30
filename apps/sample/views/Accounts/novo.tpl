<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastrar novo usuário</h1>
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
                        <input autocomplete="disabled"  required name="username" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Senha</label>
                        <input autocomplete="disabled"  required name="password" type="password" class="form-control">
                    </div>
                    <input  name="role" type="hidden" value="admin">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>