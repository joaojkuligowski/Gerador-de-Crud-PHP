<?php
function get_base_dir() {
    return dirname(__FILE__);
}
require_once get_base_dir() . '/configs.php';

$sql = 'DROP TABLE IF EXISTS users';
$pdo->exec($sql);

$sql = 'DROP TABLE IF EXISTS drivers';
$pdo->exec($sql);

$sql = 'DROP TABLE IF EXISTS vehicle_use';
$pdo->exec($sql);

$sql = 'DROP TABLE IF EXISTS vehicles';
$pdo->exec($sql);

$sql = 'DROP TABLE IF EXISTS uso_veiculos';
$pdo->exec($sql);

$sql = 'DROP TABLE IF EXISTS veiculos';
$pdo->exec($sql);

$sql = 'DROP TABLE IF EXISTS motoristas';
$pdo->exec($sql);

$sql = 'DROP TABLE IF EXISTS usuarios';
$pdo->exec($sql);

$sql = 'CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)';
$pdo->exec($sql);

$sql = 'INSERT INTO usuarios (id, username, password) VALUES (:id, :username, :password)';
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
':id' => 1,
':username' => 'demo',
':password' => password_hash('demo', PASSWORD_DEFAULT)
));

$sql = 'CREATE TABLE IF NOT EXISTS motoristas (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    cnh_category VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)';
$pdo->exec($sql);

// Insere um motorista de exemplo na tabela "drivers"
$sql = 'INSERT INTO motoristas (name, phone, cnh_category) VALUES (:name, :phone, :cnh_category)';

$stmt = $pdo->prepare($sql);

$stmt->execute(array(
':name' => 'João da Silva',
':phone' => '11999999999',
':cnh_category' => 'B'
));

// Cria a tabela "vehicles"
$sql = 'CREATE TABLE IF NOT EXISTS veiculos (
    id SERIAL PRIMARY KEY,
    plate VARCHAR(7) NOT NULL,
    vehicle_category VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)';
$pdo->exec($sql);

echo "Executando migração da tabela vehicles ✔️\n";

// criar uma tabela relacionada a veiculos chamada veiculos_tipo, relacionando com a tabela veiculos->id

$sql = 'INSERT INTO veiculos (plate, vehicle_category) VALUES (:plate, :vehicle_category)';
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
':plate' => 'ABC1234',
':vehicle_category' => 'A'
));


// Cria a tabela "vehicle_use"
$sql = 'CREATE TABLE IF NOT EXISTS uso_veiculos (
    id SERIAL PRIMARY KEY,
    driver_id INT NOT NULL,
    vehicle_id INT NOT NULL,
    use_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (driver_id) REFERENCES motoristas (id),
    FOREIGN KEY (vehicle_id) REFERENCES veiculos (id)
)';
$pdo->exec($sql);

// Insere um uso de veículo de exemplo na tabela "vehicle_use"
$sql = 'INSERT INTO uso_veiculos (driver_id, vehicle_id, use_date) VALUES (:driver_id, :vehicle_id, :use_date)';
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
':driver_id' => 1,
':vehicle_id' => 1,
':use_date' => '2020-01-01 00:00:00'
));

echo "Pronto! Acesse o sistema: " . "\n";
echo "Usuário: demo" . "\n";
echo "Senha: demo" . "\n";