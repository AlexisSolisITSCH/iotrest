<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 'name', 'type', 'value', 'date', 'user_id'
    ];

    protected $hidden = [
        'password',
    ];
}
