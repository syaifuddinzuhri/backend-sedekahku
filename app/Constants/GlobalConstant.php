<?php

namespace App\Constants;

class GlobalConstant
{
    const SUPER_ADMIN = 'super_admin';
    const ADMIN = 'admin';
    const SUPPLIER = 'supplier';
    const CUSTOMER = 'customer';

    const USER_ROLES = [self::SUPPLIER, self::SUPER_ADMIN, self::ADMIN, self::CUSTOMER];

    const POPUP = 'popup';
    const SLIDESHOW = 'slideshow';

    const POST_CATEGORIES = [self::POPUP, self::SLIDESHOW];

    const WAITING = 'WAITING';
    const PENDING = 'PENDING';
    const PAID = 'PAID';
    const PAYMENT_STATUS = [self::WAITING, self::PENDING, self::PAID];

    const PROCESS = 'PROCESS';
    const DONE = 'DONE';
    const CANCELLED = 'CANCELLED';
    const ORDER_STATUS = [self::PENDING, self::PROCESS, self::DONE, self::CANCELLED];
}
