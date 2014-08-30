<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Editar alerta</h1>
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
                <form id="novaagenda" action="<?php echo ROOT_URL; ?>agendas/editar" method="post" role="form">
                    <input name="holiday_id" type="hidden" value="<?php echo $data->holiday_id; ?>" >
                    <input name="client_ids" type="hidden" value="<?php echo $data->client_ids; ?>" >
                    <div class="form-group">
                        <label>Nome da Comemoração</label>
                        <div><?php echo $data->holiday_name; ?></div>
                    </div>
                    <div class="form-group">
                        <label>Data</label>
                        <div><?php echo $data->holiday_date; ?></div>
                    </div>
                    <div class="form-group">
                        <select id="clientid_tags"  data-placeholder="Escolha os clientes" multiple  name="client_id[]" type="text" class="form-control">
                            <option value="0">Todos os clientes</option>
                            <?php foreach($clientes as $cliente){ ?>
                            <option <?php echo in_array($cliente->id, explode(',', $data->client_ids)) ? 'selected' : '';  ?>  value="<?php echo $cliente->id; ?>"><?php echo $cliente->name; ?> - <?php echo $cliente->email; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Editar alerta</button>
                </form>
            </div>
        </div>
    </div>
</div>