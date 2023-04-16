<?php 

namespace App\Helpers;

class Label
{
    public static function get($antiga)
    {
        $traducoes = array(
            'criado_em' => 'Criado em',
            'atualizado_em' => 'Atualizado em',
            'uso_veiculos' => 'Uso de Veículos',
            'Uso veiculos' => 'Uso de Veículos',
            'veiculos' => 'Veículos',
            'Usuarios' => 'Usuários',
            'motoristas' => 'Motoristas',
            'id' => 'ID',
            'driver_ID' => 'Motorista',
            'vehicle_ID' => 'Veículo',
            'use_date' => 'Data de Uso',
            'plate' => 'Placa',
            'vehicle_category' => 'Categoria',
            'username' => 'Usuário',
            'usuarios' => 'Usuários',
            'password' => 'Senha',
            'name' => 'Nome',
            'phone' => 'Telefone',
            'cnh_category' => 'Categoria CNH'
        );
        $nova = str_replace(array_keys($traducoes), array_values($traducoes), $antiga);
        return $nova;
    }
}