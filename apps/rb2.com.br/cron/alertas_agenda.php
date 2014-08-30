<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require dirname(dirname(dirname(dirname(__FILE__)))) . '/libs/FRAPS/Loader.php';
$connection = FRAPS\DBC\Connection::init();
$sql = "SELECT * , "
        . "(SELECT GROUP_CONCAT(name SEPARATOR ', ') FROM clients WHERE id IN (SELECT client_id FROM holidays_tasks WHERE holiday_id = holiday_id)) AS client_name , "
        . "(SELECT description FROM holidays WHERE id = holiday_id) AS holiday_name, "
        . "(SELECT holiday_date FROM holidays WHERE id = holiday_id) AS hdate, "
        . "(SELECT DATE_FORMAT(holiday_date, '%d/%m/%Y') FROM holidays WHERE id = holiday_id) AS holiday_date "
        . "FROM holidays_tasks WHERE holiday_id IN (SELECT id FROM holidays WHERE "
        . "(DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 7 DAY), '%Y-%m-%d') = holiday_date "
        . "OR DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 4 DAY), '%Y-%m-%d') = holiday_date "
        . "OR DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY), '%Y-%m-%d') = holiday_date)) GROUP BY holiday_id";
$stmt = $connection->query($sql);
$alerts = $stmt->fetchAll();
?>
<?php
if (sizeof($alerts)) {
    ob_start();
    ?>
    <h2>Existem alertas pendentes, veja a lista de datas abaixo</h2>
    <table style="border:1px solid #222;width:100%;">
        <tr style="background: #444;color: #eee;"><td style="padding:5px;"><b>Nome do alerta</b></td><td style="padding:5px;"><b>Data</b></td><td style="padding:5px;"><b>Clientes</b></td></tr>
        <?php foreach ($alerts as $alert) { ?>
            <tr>
                <td style="padding:5px;">
                    <?php echo $alert->holiday_name; ?>
                </td>
                <td style="padding:5px;">
                    <?php echo $alert->holiday_date; ?>
                </td>
                <td style="padding:5px;">
                    <?php echo strlen($alert->client_name) > 100 ? substr($alert->client_name,0,100).'...' : $alert->client_name; ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php
    $body = ob_get_contents();
    ob_end_clean();
    Sendmail::send(array(
        'subject' => 'Gerenciador de  Domínios - Alertas',
        'from_name' => 'Gerenciador de  Domínios',
        'from_email' => 'noreply@rb2.com.br',
        'sender_email' => 'noreply@rb2.com.br',
        'to_email' => 'contato@rb2.com.br',
        'to_name' => 'Rogério Billhan',
        'body' => $body,
    ));
}
?>