<?php
namespace Pages;

    use App\Database;
    use App\Connection;
    use App\Auth;
    use App\Helpers\Label;
    use App\Crud;

    class Header
    {
        public static function getHeader($get_table)
        {
            $tables = Database::getTables();
            $menu_item = '';
            $menu_item .= '<li class="nav-item">';
            $menu_item .= '<a class="nav-link" href="index.php">';
            $menu_item .= '<b>Dashboard</b>';
            $menu_item .= '</a></li>';
            foreach ($tables as $table) {
                $table_name = $table['table_name'];
                $formatted_table_name = $table_name;
                $formatted_table_name = str_replace('_', ' ', $formatted_table_name);
                $is_active = ($get_table === $table_name) ? 'active' : '';

                $menu_item .= '<li class="nav-item">';
                $menu_item .= '<a class="nav-link ' . $is_active . '" href="index.php?table=' . $table_name . '">';
                $menu_item .= '<b>' . Label::get(ucfirst($formatted_table_name)) . '</b>';
                $menu_item .= '</a></li>';
            }
            return $menu_item;
        }
    }
?>