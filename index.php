<?php
declare(strict_types = 1);
define('CONTROLE', true);

require 'vendor/autoload.php';

use Controle\Models\Controle;

$controle = new Controle;
//var_dump($controle);

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