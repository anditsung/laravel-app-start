<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class PermissionRole extends Pivot
{
    use RefreshesPermissionCache;
}
