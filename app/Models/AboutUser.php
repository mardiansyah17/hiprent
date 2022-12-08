<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUser extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function dateOfBirth(): Attribute
    // {
    //     return new Attribute(
    //         get: function ($val) {
    //             $arrStr =    array_reverse(explode('-', $val));
    //             return implode('/', $arrStr);
    //         },
    //     );
    // }
}
