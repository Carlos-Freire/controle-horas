<?php
declare(strict_types = 1);
define('CONTROLE', true);

require __DIR__ . '/bootstrap.php';

/*
 *
 * adicionando o codigo que verifica se o usuário está logado
 * se não estiver logado será redirecionado para a home
 */
if (check_logged_user() == false) {
    header("Location: " . get_base_url());
    exit;
}

use Controle\Controllers\IndexController;
use Controle\Controllers\Router;

//chamo o index controller
$controller = new IndexController;
$router = new Router($controller,array(
    'index',
    'pdf',
    'chart',
    'add',
    'edit',
    'delete',
    'datatables'
),'index');
//exibe a view de acordo com a action chamada
$router->show();