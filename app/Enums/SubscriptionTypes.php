<?php

namespace App\Enums;

enum SubscriptionTypes: string
{
    case BASIC = 'Basic';
    case PREMIUM = 'Premium';
    case VIP = 'VIP';

    public static function values(): array
    {
        return array_column(SubscriptionTypes::cases(), 'value');
    }
}
