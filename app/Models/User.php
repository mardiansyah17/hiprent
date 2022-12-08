<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                // 'source' => ['first_name', 'last_name'],
                'separator' => '-'
            ]
        ];
    }


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // protecte $with
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    public function photos()
    {
        return $this->hasMany(UrlPostPhoto::class);
    }


    public function jmlTeman(): Attribute
    {
        return new Attribute(
            get: function () {
                return count(array_intersect(
                    $this->find(Auth()->id())->allFriend->pluck('id')->toArray(),
                    $this->allFriend->pluck('id')->toArray()
                ));
            }
        );
    }


    public function saranTeman(): Attribute
    {
        return new Attribute(
            function () {
                return $this->with(['teman', 'temanDua', 'pendingTeman'])->doesntHave('pendingTeman')->get()->where('id', '!=', 1)->whereNotIn('id', $this->allFriend->pluck('id'));
            }
        );
    }

    public function teman()
    {
        return $this->belongsToMany(User::class, 'friend', 'user_id', 'friend_id')->withPivot('status');
    }
    public function temanDua()
    {
        return $this->belongsToMany(User::class, 'friend', 'friend_id', 'user_id')->withPivot('status');
    }

    public function allFriend(): Attribute
    {
        return new Attribute(
            get: function () {
                $x = $this->teman->merge($this->temanDua);
                return $x;
            }
        );
    }

    public function conversations1()
    {
        return $this->belongsToMany(User::class, 'conversations', 'user_one', 'user_two')->withPivot('id')->withPivot(['updated_at', 'last_message', 'unread_one', 'unread_two'])->wherePivot('deleted_at', '!=', Auth()->id());
    }
    public function conversations2()
    {
        return $this->belongsToMany(User::class, 'conversations', 'user_two', 'user_one')->withPivot('id')->withPivot(['updated_at', 'last_message', 'unread_one', 'unread_two'])->wherePivot('deleted_at', '!=', Auth()->id());
    }

    public function conversations(): Attribute
    {
        return new Attribute(
            get: function () {
                $x = $this->conversations1->merge($this->conversations2);
                // dd($x);
                return $x;
            }
        );
    }



    public function pendingTeman()
    {
        return $this->belongsToMany(User::class, 'friend', 'friend_id', 'user_id')->wherePivot('status', '=', false);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function notifications()
    {
        return    $this->hasMany(Notification::class, 'send_to', 'id');
    }

    // public function dateOfBirth(): Attribute
    // {
    //     return new Attribute(
    //         get: function ($val) {
    //             $month = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
    //             $dateArr =    explode('-', $val);
    //             return "{$dateArr[1]} {$month[$dateArr[1]]} {$dateArr[0]}";
    //             // return  implode(' ', );
    //         }
    //     );
    // }
}
