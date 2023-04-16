<?php
namespace Pages;

use App\Helpers\Label;
use App\Database;
use App\Crud;

$fields = Database::getColumns($get_table);
$fields_exclusion = array('id', 'criado_em', 'atualizado_em');
$fields = array_filter($fields, function ($field) use ($fields_exclusion) {
    return !in_array($field['column_name'], $fields_exclusion);
});
$get_action = isset($_GET['action']) ? $_GET['action'] : 'read';
$boot = '';
switch
($get_action) {
    case 'read':
        $registros_por_pagina = 5;
        if (isset($_GET['pagina'])) {
            $pagina_atual = $_GET['pagina'];
        } else {
            $pagina_atual = 1;
        }
        $primeiro_registro = ($pagina_atual - 1) * $registros_por_pagina;
        $list_completa = Crud::all($get_table);
        $total_registros = count($list_completa);
        $list = array_slice($list_completa, $primeiro_registro, $registros_por_pagina);
        $boot = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Novo ' . Label::get($get_table) . '</button>';
        break;
    case 'edit':
        include('pages/edit.php');
        break;
    case 'delete':
        $list = Crud::delete($get_table, $data);
        break;
    case 'update':
        break;
    default:
        $list = Crud::read($get_table, $data);
        $boot = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Novo ' . Label::get($table) . '</button>';
}
?>

<div class="user-dashboard">
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Novo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="create">
                        <input type="hidden" name="table" value="<?php echo $get_table ?>">
                        <?php
                        foreach($fields as $field) {?>
                        <div class="mb-3">
                            <label for="<?php echo $field['column_name'] ?>" class="form-label"><?php echo Label::get($field['column_name']) ?></label>
                            <?php 
                                if($field['column_name'] == 'password'){
                                    $input_type = 'password';
                                    $input_value = '';
                                } else {
                                    $input_type = 'text';
                                    $input_value = $list[$value['column_name']];
                                }
                            ?>
                            <input type="<?php echo $input_type ?>" class="form-control" id="<?php echo $field['column_name'] ?>" name="<?php echo $field['column_name'] ?>" value="<?php echo $input_value ?>">
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" data-bs-create="modal">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h1><?php echo Label::get($get_table) ? Label::get($get_table) : 'Dashboard' ?></h1>
    <div class="row">
        <table class="table table-striped">
            <?php echo $boot;?>
            <thead>
            <tr>
                <?php foreach (array_keys($list[0]) as $column_name) { ?>
                <th><?php echo Label::get($column_name); ?></th>
                <?php } ?>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $key => $value) {?>
            <tr>
                    <?php foreach ($value as $column_value) { ?>
                <td><?php echo $column_value; ?></td>
                <?php } ?>
                <td>
                        <?php
                        $idedit = $value['id'];
                    if($idedit == $idedit)
                    { ?>
                    <a href="index.php?action=edit&table=<?php echo $get_table ?>&id=<?php echo $value['id'] ?>" class="btn btn-primary">Editar</a>
                    <button type="submit" id="del" class="btn btn-danger" value="<?php echo $get_table ?>|<?php echo $value['id'] ?>" >Excluir</button>
                    <?php } ?>

                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
        $total_paginas = ceil($total_registros / $registros_por_pagina);
        if ($total_paginas > 1) {
            echo '<nav aria-label="Paginação">';
            echo '<ul class="pagination">';
            for ($i = 1; $i <= $total_paginas; $i++) {
                echo '<li class="page-item ';
                if ($i == $pagina_atual) {
                    echo 'active';
                }
                echo '"><a class="page-link" href="?table=' . $get_table . '&pagina=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul>';
            echo '</nav>';
        }
        ?>
    </div>
</div>

