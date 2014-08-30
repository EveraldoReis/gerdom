<div class="form-group">
    <label>Domínio</label>
    <input  required name="dominios[domain]" type="text" class="form-control">
</div>
<div class="form-group">
    <label>Data de cadastro</label>
    <input  required name="dominios[cdate]" value="<?php echo date('Y-m-d'); ?>" type="text" class="form-control">
</div>
<div class="form-group">
    <label>Desabilitar pagamento</label>
    <label class="checkbox-inline">
        <input name="dominios[free]" value="1" type="checkbox"/>
    </label>
</div>