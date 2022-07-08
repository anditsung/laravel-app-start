<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    // https://orkhan.dev/2020/08/17/using-traits-to-boot-and-initialize-eloquent-models/

//    public static function bootHasUuid()
//    {
//        static::creating(function (Model $model) {
//            if (!$model->uuid) {
//                $model->uuid = Str::uuid()->toString();
//            }
//        });
//    }

    public function initializeHasUuid()
    {
        $this->uuid = Str::uuid()->toString();
    }
}
