<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestor de Domínios</title>
        <!-- Core CSS - Include with every page -->
        <link href="<?php echo ROOT_URL; ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo ROOT_URL; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo ROOT_URL; ?>css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
        <link href="<?php echo ROOT_URL; ?>css/chosen.min.css" rel="stylesheet">
        <link href="<?php echo ROOT_URL; ?>css/jquery-ui.min.css" rel="stylesheet">
        <link href="<?php echo ROOT_URL; ?>css/sb-admin.css" rel="stylesheet">
    </head>
    <body>
        <?php echo $this->element('warning'); ?>
        <?php echo $this->fetch('content'); ?>
        <!-- Core Scripts - Include with every page -->
        <script src="<?php echo ROOT_URL; ?>js/jquery-1.10.2.js"></script>
        <script src="<?php echo ROOT_URL; ?>js/jquery-ui.min.js"></script>
        <script src="<?php echo ROOT_URL; ?>js/bootstrap.min.js"></script>
        <script src="<?php echo ROOT_URL; ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo ROOT_URL; ?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo ROOT_URL; ?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script src="<?php echo ROOT_URL; ?>js/chosen.jquery.min.js"></script>
        <script src="<?php echo ROOT_URL; ?>js/sb-admin.js"></script>
        <script src="<?php echo ROOT_URL; ?>js/theme.js"></script>
    </body>
</html>
