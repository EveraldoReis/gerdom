<table class="table table-hover">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($holidays as $holiday){ ?>
        <tr>
            <td class="col-sm-12 col-md-3">
                <?php echo $holiday->description; ?>
            </td>
            <td class="col-sm-12 col-md-3">
                <?php echo $holiday->holiday_date; ?>
            </td>
            <td class="col-sm-12 col-md-3">
                <div class="col-sm-12 col-md-6">
                    <form method="post" action="<?php echo ROOT_URL; ?>comemoracoes/remover">
                        <input type="hidden" name="id" value="<?php echo $holiday->id; ?>" />
                        <button class="delete btn btn-xs">Deletar</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>