<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'roles';
    protected $fillable = [
        'name', 
    ];

    // public function user()
    // {
    // 	return $this->belongTo('App\User');
    // }
}
