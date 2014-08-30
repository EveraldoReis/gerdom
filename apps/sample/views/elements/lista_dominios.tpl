<?php $i = 1;$tab = 0;foreach($domains as $domain){  
$last_payment = empty($domain->last_payment) ? $domain->cdate : $domain->last_payment; 
?>
<tr data-id="<?php echo $domain->id; ?>" class="data tab <?php echo ($i%10) == 0 ? 'tab'.$tab++ : 'tab'.$tab; ?>">
    <td><?php echo !$domain->free ? $domain->id : 'free_'.$domain->id; ?></td>
    <td class="domain col-sm-12 col-md-4"><?php echo $domain->domain; ?></td>
    <?php if(!$domain->free){ ?>
    <?php if(date('Y-m', strtotime('+31 days', strtotime($last_payment))) == date('Y-m')){ ?>
    <td class="success status vencido col-sm-12 col-md-4"><?php echo  "Pago até " ?> <?php echo date('m/Y', strtotime($last_payment)); ?> (vencido)</td>        
    <?php }elseif(date('Y-m', strtotime('+31 days', strtotime($last_payment))) < date('Y-m')){ ?>
    <td class="danger status vencido col-sm-12 col-md-4"><?php echo "Em aberto desde " ?><?php echo date('m/Y', strtotime($last_payment)); ?></td>                                    
    <?php }else{ ?>
    <td class="status pago col-sm-12 col-md-4"><span class="btn btn-xs disabled"><?php echo "Pago até " ?><?php echo date('m/Y', strtotime($last_payment)); ?></span></td>
    <?php } ?>
    <?php }else{ ?>
    <td class="status gratis col-sm-12 col-md-4"><span class="btn btn-xs disabled">Dominio gratis (sem cobrança)</span></td>
    <?php } ?>
    <td class="col-sm-12 col-md-4">
        <?php if(!$domain->free){ ?>
        <?php if(date('Y-m', strtotime($last_payment)) < date('Y-m')){ ?>
        <div class="col-sm-12 col-md-6">
            <button data-id="<?php echo $domain->id; ?>" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal<?php echo $domain->id; ?>">Comunicar pagto</button>
            <div class="modal fade" id="myModal<?php echo $domain->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Selecione o período</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="<?php echo ROOT_URL; ?>pagamentos/novo">
                                <input type="hidden" name="domain_id" value="<?php echo $domain->id; ?>" />
                                <input type="text" name="last_payment" value="<?php echo date('Y-m-d', strtotime('+31 days', strtotime($last_payment))); ?>" />
                                <button class="btn btn-primary btn-xs">Comunicar pagto</button>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
        <?php } ?>
        <?php if(!empty($domain->last_payment)){ ?>
        <div class="col-sm-12 col-md-6">
            <form method="post" action="<?php echo ROOT_URL; ?>pagamentos/remover">
                <input type="hidden" name="id" value="<?php echo $domain->payment_id; ?>" />
                <button class="btn btn-xs">Revogar último pagamento</button>
            </form>
        </div>
        <?php } ?>
        <?php } ?>
    </td>
</tr>                            
<?php $i++;} ?>