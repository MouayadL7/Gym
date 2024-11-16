<?php

namespace App\Enums;

enum UserRoles: string
{
    case CLIENT = 'client';
    case TRAINER = 'trainer';
    case ADMIN = 'admin';

    public static function values(): array
    {
        return array_column(UserRoles::cases(), 'value');
    }
}
