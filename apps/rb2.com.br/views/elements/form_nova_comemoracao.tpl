<form action="<?php echo ROOT_URL; ?>comemoracoes/novo" method="post" role="form">
    <div class="form-group">
        <label>Comemoração</label>
        <input  required name="description" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>Data de cadastro</label>
        <input  required name="holiday_date" value="<?php echo date('Y-m-d'); ?>" type="text" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>