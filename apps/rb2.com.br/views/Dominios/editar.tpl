
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Editar domínio</h1>
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
                <form method="post" ation="<?php echo ROOT_URL; ?>dominios/editar" role="form">
                    <div class="form-group">
                        <label>Domínio</label>
                        <input  required value="<?php echo $data->domain; ?>" name="domain" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Data de cadastro</label>
                        <input  required name="cdate" value="<?php echo date('Y-m-d', strtotime($data->cdate)); ?>" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Cliente</label>
                        <select  required name="client_id" type="text" class="form-control">
                            <?php foreach($clientes->getAll() as $cliente){ ?>
                            <option <?php echo $cliente->id == $data->client_id ? 'selected' : ''; ?> value="<?php echo $cliente->id; ?>"><?php echo $cliente->name; ?> - <?php echo $cliente->email; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><input <?php echo $data->free ? 'checked' : ''; ?> name="free" value="1" type="radio"/> Desabilitar pagamento </label> | 
                        <label><input <?php echo !$data->free ? 'checked' : ''; ?> name="free" value="0" type="radio"/> Habilitar pagamento </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>