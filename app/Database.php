<?php

namespace App;

use App\Connection;
use PDO;

class Database
{
    public static function getPDO()
    {
        $pdo = new Connection();
        return $pdo->getConnection();
    }

    public static function getColumns($table)
    {

        $pdo = Database::getPDO();
        $sql = 'SELECT column_name FROM information_schema.columns WHERE table_name = :table';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':table' => $table
        ));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getTables()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT table_name FROM information_schema.tables WHERE table_schema = :schema';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':schema' => 'public'
        ));
        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tables;
    }
    public static function count($table)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT COUNT(*) FROM ' . $table;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
}
?>