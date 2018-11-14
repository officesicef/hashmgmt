<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pain extends Model
{
    protected $table = "pains";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id','scale'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at','patient_id'
    ];
}
