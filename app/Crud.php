<?php

namespace App;

class Crud
{
    public static function create($table, $data)
{
    $pdo = Database::getPDO();
    $date = date('Y-m-d H:i:s');
    $data['criado_em'] = $date;
    $data['atualizado_em'] = $date;
    $columns = array_keys($data);
    $columns = implode(', ', $columns);
    $values = array_map(function ($value) {
        return ':' . $value;
    }, array_keys($data));    
    $values = implode(', ', $values);
    $sql = 'INSERT INTO ' . $table . ' (' . $columns . ') VALUES (' . $values . ')';
    $stmt = $pdo->prepare($sql);
    
    foreach ($data as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }
    
    $stmt->execute();
    return $pdo->lastInsertId();
    }

    public static function read($table, $id)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM ' . $table . ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':id' => $id
        ));
        $data = $stmt->fetch($pdo::FETCH_ASSOC);
        return $data;
    }
    public static function delete($table, $id)
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM ' . $table . ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':id' => $id
        ));
    }
    public static function update($table, $id, $data)
    {
        $pdo = Database::getPDO();
        $date = date('Y-m-d H:i:s');
        $data['atualizado_em'] = $date;
        $setValues = array_map(function ($value) {
            return $value.'=:'.$value;
        }, array_keys($data));
        $setValues = implode(', ', $setValues);
        $sql = 'UPDATE ' . $table . ' SET ' . $setValues . ' WHERE id=:id';
        $stmt = $pdo->prepare($sql);

        // bind dos valores
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->bindValue(':id', $id);

        $stmt->execute();
        return $stmt->rowCount();
    }
    public static function all($table)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM ' . $table . ' ORDER BY id ASC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll($pdo::FETCH_ASSOC);
        return $data;
    }

    public static function purequery($query)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll($pdo::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public static function getInputField($field, $list) {
        $html = '<div class="mb-3">';
        $html .= '<label for="' . $field['column_name'] . '" class="form-label">' . Label::get($field['column_name']) . '</label>';
    
        $input_type = 'text';
        $input_value = isset($list[$field['column_name']]) ? $list[$field['column_name']] : '';
    
        switch ($field['data_type']) {
            case 'int':
            case 'tinyint':
            case 'smallint':
            case 'mediumint':
            case 'bigint':
                $input_type = 'number';
                break;
            case 'decimal':
            case 'float':
            case 'double':
                $input_type = 'number';
                $html .= '<span class="input-group-text">R$</span>';
                break;
            case 'date':
                $input_type = 'date';
                break;
            case 'datetime':
                $input_type = 'datetime-local';
                break;
            case 'time':
                $input_type = 'time';
                break;
            case 'year':
                $input_type = 'number';
                break;
            case 'char':
            case 'varchar':
            case 'text':
            case 'longtext':
                if ($field['column_name'] == 'password') {
                    $input_type = 'password';
                } else if ($field['column_name'] == 'email') {
                    $input_type = 'email';
                }
                break;
            case 'enum':
                $input_type = 'select';
                $options = explode(',', str_replace("'", '', substr($field['column_type'], 5, -1)));
                $html .= '<select class="form-select" id="' . $field['column_name'] . '" name="' . $field['column_name'] . '">';
                foreach ($options as $option) {
                    $html .= '<option value="' . $option . '"' . ($option == $input_value ? ' selected' : '') . '>' . $option . '</option>';
                }
                $html .= '</select>';
                break;
            case 'set':
                $input_type = 'checkbox';
                $options = explode(',', str_replace("'", '', substr($field['column_type'], 4, -1)));
                foreach ($options as $option) {
                    $html .= '<div class="form-check form-check-inline">';
                    $html .= '<input class="form-check-input" type="checkbox" id="' . $field['column_name'] . '_' . $option . '" name="' . $field['column_name'] . '[]" value="' . $option . '"' . (in_array($option, explode(',', $input_value)) ? ' checked' : '') . '>';
                    $html .= '<label class="form-check-label" for="' . $field['column_name'] . '_' . $option . '">' . $option . '</label>';
                    $html .= '</div>';
                }
                break;
        }
    
        if ($input_type != 'select' && $input_type != 'checkbox') {
            $html .= '<input type="' . $input_type . '" class="form-control" id="' . $field['column_name'] . '" name="' . $field['column_name'] . '" value="' . $input_value . '">';
        }
    
        $html .= '</div>';
    
        return $html;
    }
}

