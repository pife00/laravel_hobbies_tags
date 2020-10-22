<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;
    
    function user()
    {
       return $this->belongsTo('App\Models\User');
    }

    function tags()
    { return $this->belongsToMany('App\Models\Tag');
    
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'user_id'
    ];
}
