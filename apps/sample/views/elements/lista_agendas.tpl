<table id="agendas" class="table table-hover">
    <thead>
        <tr>
            <th>Comemoração</th>
            <th>Cliente</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tasks as $task){ ?>
        <tr>
            <td class="col-sm-12 col-md-3">
                <?php echo $task->holiday_name; ?> (<?php echo $task->holiday_date; ?>)
            </td>
            <td class="col-sm-12 col-md-3">
                <?php echo strlen($task->client_name) > 100 ? substr($task->client_name,0,100).'...' : $task->client_name; ?>
            </td>
            <td class="col-sm-12 col-md-3">
                <div class="col-sm-12 col-md-4">
                    <form method="post" action="<?php echo ROOT_URL; ?>agendas/remover">
                        <input type="hidden" name="holiday_id" value="<?php echo $task->holiday_id; ?>" />
                        <button class="btn btn-xs delete">Deletar</button>
                    </form>
                </div>
                <div class="col-sm-12 col-md-4">
                    <a class="btn btn-xs btn-primary" href="<?php echo ROOT_URL; ?>agendas/editar/<?php echo $task->holiday_id; ?>">Editar</a>
                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>