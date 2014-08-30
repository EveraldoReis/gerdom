<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Domínios
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary btn-xs" data-toggle="modal" id="myModalSelectedsButton" data-target="#myModalSelecteds">Pagar selecionados</button>
        <div class="modal fade" id="myModalSelecteds" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Selecione o período</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="<?php echo ROOT_URL; ?>pagamentos/novo_multi">
                            <input type="hidden" name="domain_id_list"  />
                            <input type="text" name="last_payment" value="<?php echo date('Y-m-d', strtotime('-31 days')); ?>" />
                            <button class="btn btn-primary btn-xs">Pagar selecionados</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-xs btn-primary" href="/dominios/salvar_pdf">Salvar em PDF</a>
    </div>
</div>
<hr>
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
                    <table id="domains" class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th class="check">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="select_all"/>
                                    </label>
                                </th>
                                <th>Domínio</th>
                                <th>
                                    Situação
                                </th>
                                <th>
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $this->element('lista_dominios'); ?>
                        </tbody>
                    </table>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- Modal -->