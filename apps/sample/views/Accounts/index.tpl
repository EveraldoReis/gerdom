<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Usuários</h1>
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
                                <th>Usuário</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($accounts as $account){ ?>
                            <tr>
                                <td>
                                    <?php echo $account->username; ?>
                                </td>
                                <td>
                                    <?php echo $account->role; ?>
                                </td>
                                <td>
                                    <?php if(sizeof($accounts)>1){ ?>
                                    <form class="col-sm-4 col-md-4" method="post" action="<?php echo ROOT_URL; ?>accounts/remover">
                                        <input type="hidden" name="id" value="<?php echo $account->id; ?>" />
                                        <button class="btn btn-xs delete">Deletar conta</button>
                                    </form>            
                                    <?php } ?>
                                    <a class="col-sm-4 col-md-4" href="<?php echo ROOT_URL; ?>accounts/editar/<?php echo $account->id; ?>">Editar</a>
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