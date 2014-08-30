
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Clientes</h1>
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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Dominios</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($this->model->getAll() as $client){ ?>
                            <tr>
                                <td><?php echo $client->name; ?></td>
                                <td><?php echo $client->email; ?></td>
                                <td><?php echo $client->telephone; ?></td>
                                <td><?php echo $client->domains; ?></td>
                                <td>
                                    <form class='col-sm-4 col-md-4' method="post" action="<?php echo ROOT_URL; ?>clientes/remover">
                                        <input type="hidden" name="id" value="<?php echo $client->id; ?>" />
                                        <button class="btn btn-xs delete">Excluir</button>
                                    </form>
                                    <a class='col-sm-4 col-md-4' href="<?php echo ROOT_URL; ?>clientes/editar/<?php echo $client->id; ?>" class="btn btn-xs">Editar</a>
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