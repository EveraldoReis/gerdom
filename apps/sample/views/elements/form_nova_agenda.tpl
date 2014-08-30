<form id="novaagenda" action="<?php echo ROOT_URL; ?>agendas/novo" method="post" role="form">
    <div class="form-group">
        <label>Nome da Comemoração</label>
        <input  required name="holiday[description]" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>Data</label>
        <input  required name="holiday[holiday_date]" value="<?php echo date('Y-m-d'); ?>" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>Todos os clientes</label>
        <input  name="all_clients" value="1" type="checkbox">
    </div>
    <div class="form-group">
        <select id="clientid_tags"  data-placeholder="Escolha os clientes" multiple  name="holiday_tasks[client_id][]" type="text" class="form-control">
            <?php foreach($clientes as $cliente){ ?>
            <option value="<?php echo $cliente->id; ?>"><?php echo $cliente->name; ?> - <?php echo $cliente->email; ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Criar novo alerta</button>
</form>