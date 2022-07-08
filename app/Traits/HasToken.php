<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasToken
{
    // https://orkhan.dev/2020/08/17/using-traits-to-boot-and-initialize-eloquent-models/

    public static function bootHasToken()
    {
        static::creating(function (Model $model) {
            if (!$model->token) {
                $model->token = Str::uuid()->toString();
            }
        });
    }

//    public function initializeHasToken()
//    {
//        $this->token = Str::uuid()->toString();
//    }
}
