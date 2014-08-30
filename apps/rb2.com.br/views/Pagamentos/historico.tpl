
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Histórico de pagamentos</h1>
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
                                <th>Último pagamento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($this->model->getAll(array('domain_id'=>$this->request->params[0])) as $payment){  
                            $last_payment = empty($payment->last_payment) ? $payment->cdate : $payment->last_payment; 
                            ?>
                            <tr>
                                <td><?php echo $payment->domain_name; ?></td> 
                                <td><?php echo date('Y-m', strtotime($last_payment)); ?></td> 
                                <td>
                                    <form method="post" action="<?php echo ROOT_URL; ?>pagamentos/remover">
                                        <input type="hidden" name="id" value="<?php echo $payment->id; ?>" />
                                        <button class="btn btn-xs delete">Revogar pagamento</button>
                                    </form>
                                </td> 
                            </tr>                            
                            <?php } ?>
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