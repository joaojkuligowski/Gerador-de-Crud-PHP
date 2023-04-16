<?php
include_once 'vendor/autoload.php';

use App\Migration;

print("Você já criou seu banco de dados Postgres e inseriu os dados no arquivo .env? S/N: ");
$option = strtolower(trim(fgets(STDIN)));

if ($option === 's') {
    Migration::start();
} else {
  echo "Por favor, crie seu banco de dados Postgres e insira os dados no arquivo .env antes de continuar.";
}
?>
