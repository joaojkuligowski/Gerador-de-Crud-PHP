<?php
include_once '../../vendor/autoload.php';
use App\Crud;

$dados = $_POST['data']['formData'];
unset($dados['table']);
unset($dados['data']['formData']['cnh_category2']);
$tabela = $_POST['data']['tabela'];
$action = $_POST['data']['action'];

if ($action == 'create') {
    Crud::create($tabela, $dados);
} elseif ($action == 'update') {
    Crud::update($tabela, $dados['id'], $dados);
} elseif ($action == 'delete') {
    Crud::delete($tabela, $dados['id']);
} elseif ($action == 'fipe') {
    getFipe::get($dados['plate']);
} elseif ($action == 'read') {
    $read = Crud::read($tabela, $dados['id']);
    var_dump($read);
} elseif ($action == 'query') {
    Crud::purequery($dados['query']);
} elseif ($action == 'edit') {
    echo "ola marilene!";
    $read = Crud::read($tabela, $dados['id']);
    var_dump($read);
}