<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dominios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $this->element('data_atual'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Domínio</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $i = 1;$tab = 0; foreach($domains as $domain){  ?>
                            <tr class="data tab <?php echo ($i%10) == 0 ? "tab".$tab++ : "tab".$tab; ?>">
                                <td class="domain"><?php echo $domain->domain; ?></td>
                                <td><?php echo $domain->free ? 'Grátis' : 'Pago'; ?></td>
                                <td>
                                    <form class='col-sm-4 col-md-4' method="post" action="<?php echo ROOT_URL; ?>dominios/remover">
                                        <input type="hidden" name="id" value="<?php echo $domain->id; ?>" />
                                        <button class="btn btn-xs delete">Excluir</button>
                                    </form>
                                    <a class='col-sm-4 col-md-4' href="<?php echo ROOT_URL; ?>dominios/editar/<?php echo $domain->id; ?>" class="btn btn-xs">Editar</a>
                                </td>
                            </tr>                            
                            <?php $i++;} ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmar pagamento</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="pagamentos/novo">
                    <input type="text" name="last_payment" />
                    <input type="hidden" name="cdate" value="<?php echo date('Y-m-d H:i:s'); ?>" />
                    <button class="btn btn-primary btn-xs">Confirmar pagamento</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->