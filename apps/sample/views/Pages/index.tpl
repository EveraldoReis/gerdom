<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Alertas</h1>
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
                                <th>Nome</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($alerts as $alert){  ?>
                            <?php if(date('Y-m-d', strtotime('+7days')) >= $alert->hdate && date('Y-m-d', strtotime('+4days')) < $alert->hdate){ ?>
                            <tr class="success">
                                <td class="col-sm-12 col-md-3">
                                    <?php echo $alert->holiday_name; ?>
                                </td>
                                <td class="col-sm-12 col-md-3">
                                    <?php echo $alert->holiday_date; ?>
                                </td>
                                <td class="col-sm-12 col-md-3">
                                    <div class="col-sm-12 col-md-6">
                                        <form method="post" action="<?php echo ROOT_URL; ?>agendas/remover">
                                            <input type="hidden" name="holiday_id" value="<?php echo $alert->holiday_id; ?>" />
                                            <button class="btn btn-xs delete">Deletar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php }elseif(date('Y-m-d', strtotime('+4days'))  >= $alert->hdate && date('Y-m-d', strtotime('+1days')) < $alert->hdate){ ?>
                            <tr class="warning">
                                <td class="col-sm-12 col-md-3">
                                    <?php echo $alert->holiday_name; ?>
                                </td>
                                <td class="col-sm-12 col-md-3">
                                    <?php echo $alert->holiday_date; ?>
                                </td>
                                <td class="col-sm-12 col-md-3">
                                    <div class="col-sm-12 col-md-6">
                                        <form method="post" action="<?php echo ROOT_URL; ?>agendas/remover">
                                            <input type="hidden" name="holiday_id" value="<?php echo $alert->holiday_id; ?>" />
                                            <button class="btn btn-xs delete">Deletar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php }elseif(date('Y-m-d', strtotime('+1days')) >= $alert->hdate){ ?>
                            <tr class="danger">
                                <td class="col-sm-12 col-md-3">
                                    <?php echo $alert->holiday_name; ?>
                                </td>
                                <td class="col-sm-12 col-md-3">
                                    <?php echo $alert->holiday_date; ?>
                                </td>
                                <td class="col-sm-12 col-md-3">
                                    <div class="col-sm-12 col-md-6">
                                        <form method="post" action="<?php echo ROOT_URL; ?>agendas/remover">
                                            <input type="hidden" name="holiday_id" value="<?php echo $alert->holiday_id; ?>" />
                                            <button class="btn btn-xs delete">Deletar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- Modal -->
    </div>