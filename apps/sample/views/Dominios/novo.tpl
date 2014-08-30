<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastrar novo domínio</h1>
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
                    <?php echo $this->element('form_novo_dominio'); ?>
                    <hr>
                    <?php if(sizeof($clientes) > 0){ ?>
                    <h4>
                        Cliente existente
                    </h4>
                    <div class="form-group">
                        <select  name="dominios[client_id]" type="text" class="form-control">
                            <option value="0">Escolha o cliente</option>
                            <?php foreach($clientes as $cliente){ ?>
                            <option value="<?php echo $cliente->id; ?>"><?php echo $cliente->name; ?> - <?php echo $cliente->email; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php } ?>
                    <h4>
                        Cadastrar novo
                    </h4>
                    <?php echo $this->element('form_novo_cliente'); ?>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>