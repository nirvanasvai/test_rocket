<?php

namespace App\Services\User;



class RolesService
{
    public function getBackUser()
    {
        return (object)[
            '1' => 'Пользователь',
            '2' => 'Администратор',
            '3' => 'Оператор',
            '4' => 'Контент менеджер',
        ];
    }
}
