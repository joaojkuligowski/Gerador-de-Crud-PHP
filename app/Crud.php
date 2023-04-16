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

}

