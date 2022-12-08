<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(UrlPostPhoto::class);
    }

    public function caption(): Attribute
    {
        return new Attribute(
            get: fn ($val) => Str::replace("\n", '<br>', $val),
            set: fn ($val) => empty($val) && !is_numeric($val) ? null : trim(strip_tags($val))
        );
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function coments()
    {
        return $this->hasMany(Coment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }





    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => null
            ]
        ];
    }
}
