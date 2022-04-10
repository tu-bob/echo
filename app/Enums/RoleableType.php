<?php
/**
 * @author Sultonazar Mamadazizov <sultonazar.mamadazizov@mail.ru>
 * @copyright Copyright (c) 2022, coded.tj
 */

namespace App\Enums;

use App\Models\User\User;

enum RoleableType: string
{
    case User = "users";
}
