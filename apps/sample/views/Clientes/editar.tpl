
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Editar cliente</h1>
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
                        <label>Nome</label>
                        <input  required value="<?php echo $data->name; ?>" name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input  value="<?php echo $data->email; ?>" name="email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input  value="<?php echo $data->telephone; ?>" name="telephone" type="text" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>