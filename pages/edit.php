<?php

namespace Pages\Edit;

use App\Helpers\Label;
use App\Database;
use App\Crud;

$fields = Database::getColumns($get_table);
$fields_exclusion = array('id', 'criado_em', 'atualizado_em');
$fields = array_filter($fields, function ($field) use ($fields_exclusion) {
    return !in_array($field['column_name'], $fields_exclusion);
});
$list = Crud::read($get_table, $get_id);
?>
<div class="user-dashboard">
    <div id="notification" class="alert alert-success">
        Usuário #<?php echo $get_id;?> editado com sucesso. <a href="index.php?table=<?php echo $get_table;?>">Voltar a Lista de <?php echo Label::get($get_table);?></a>
    </div>
    <h1><?php echo Label::get($get_table) ? Label::get($get_table) : 'Dashboard' ?> - Editar - #<?php echo $get_id;?></h1>
    <form method="post" id="edit">
        <input type="hidden" name="table" value="<?php echo $get_table ?>">
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" name="id" value="<?php echo $list['id'] ?>" readonly>
        </div>
        <?php foreach ($fields as $field) { ?>
        <div class="mb-3">
            <label for="<?php echo $field['column_name'] ?>" class="form-label"><?php echo Label::get($field['column_name']) ?></label>
            <input type="text" class="form-control" id="<?php echo $field['column_name'] ?>" name="<?php echo $field['column_name'] ?>" value="<?php echo $list[$field['column_name']] ?>">    
        </div>
        <?php } ?>
        <button type="button" class="btn btn-primary" data-bs-update="modal">Salvar</button>
    </form>
</div>
<div id="loader" style="display:none;">
    <div class="loader-dot"></div>
    <div class="loader-dot"></div>
    <div class="loader-dot"></div>
</div>

