<?php
declare(strict_types = 1);
define('CONTROLE', true);

require __DIR__ . '/bootstrap.php';

use Controle\Models\Controle;

$controle = new Controle;
$controle->setId(1);
$controle->setDev('Rafael');
$controle->setCliente('Proped');
$controle->setArea('Teste');
$controle->setDia(date("d/m/Y"));
$controle->setHoraIni(date("H:i:s"));
$controle->setHoraFim(date("H:i:s"));
echo $id = $controle->insert();


include 'src/views/header.php';
?>
    <div class="col-md-6">
        <?php include 'src/views/datatables.php'; ?>
    </div>
    <div class="col-md-6">
        <?php include 'src/views/form.php'; ?>
    </div>
<?php
include 'src/views/footer.php';