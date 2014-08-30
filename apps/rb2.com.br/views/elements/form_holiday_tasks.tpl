<form class="holiday_tasks" action="<?php echo ROOT_URL; ?>agendas/novo" method="post" role="form">
    <div class="form-group">
        <label>Vincular cliente a data selecionada</label>
        <select class="form-control" name="client_id">
            <?php foreach($clientes as $client){ ?>
            <option value="<?php echo $client->id; ?>"><?php echo $client->name; ?> - <?php echo $client->email; ?></option>
            <?php } ?>
        </select>
    </div>
    <input  required name="holiday_id" type="hidden">
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>