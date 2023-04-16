<?php
namespace App\Helpers;

class Factory
    {

    public static function gerarPlaca() 
    {
        $letras = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $numeros = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        $letra1 = $letras[rand(0,25)];
        $letra2 = $letras[rand(0,25)];
        $letra3 = $letras[rand(0,25)];
        $numero1 = $numeros[rand(0,9)];
        $numero2 = $numeros[rand(0,9)];
        $numero3 = $numeros[rand(0,9)];
        $numero4 = $numeros[rand(0,9)];

        return "$letra1$letra2$letra3$numero1$numero2$numero3$numero4";
    }
    public static function gerarNome()
    {  
        $primeirosNomes = array("João", "Maria", "Pedro", "Ana", "José", "Paulo", "Lucas", "Mariana", "Carlos", "Fernanda", "Bruno", "Amanda", "Luiz", "Larissa", "Gustavo", "Raquel", "Rafael", "Vanessa", "Marcelo", "Isabela");
        $sobrenomes = array("Silva", "Santos", "Oliveira", "Souza", "Almeida", "Ferreira", "Mendes", "Pereira", "Gomes", "Rodrigues", "Nascimento", "Costa", "Carvalho", "Moura", "Cruz", "Teixeira", "Fonseca", "Moraes", "Martins");
      
        $primeiroNome = $primeirosNomes[rand(0,count($primeirosNomes)-1)];
        $sobrenome = $sobrenomes[rand(0,count($sobrenomes)-1)];
      
        return "$primeiroNome $sobrenome";
    }
    public static function gerarCategoria() 
    {
        $categorias = array('A', 'B', 'C', 'D', 'E');
        sort($categorias);
        $num_categorias = rand(1, 5);
        return implode(',', array_slice($categorias, 0, $num_categorias));
    }
    public static function gerarCategoriaVeiculo() 
    {
        $categorias = array('A', 'B', 'C', 'D', 'E');
        sort($categorias);
        $num_categorias = rand(1, 5);
        return $categorias[array_rand($categorias)];
    }

    public static function gerarTelefone() {
        $ddd = array('11', '12', '13', '14', '15', '16', '17', '18', '19', '21', '22', '24', '27', '28', '31', '32', '33', '34', '35', '37', '38', '41', '42', '43', '44', '45', '46', '47', '48', '49', '51', '53', '54', '55', '61', '62', '63', '64', '65', '66', '67', '68', '69', '71', '73', '74', '75', '77', '79', '81', '82', '83', '84', '85', '86', '87', '88', '89', '91', '92', '93', '94', '95', '96', '97', '98', '99');
        $numero = rand(988889999, 99999999);
        $ddd_rand = array_rand($ddd);
        $telefone = $ddd[$ddd_rand] . substr($numero, 0, 4) . substr($numero, 4, 8);
        return $telefone;
      }
      
    }
    

?>