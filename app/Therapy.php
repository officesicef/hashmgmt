<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Therapy extends Model
{
    protected $table = "therapies";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','patient_id','medicine_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'updated_at','patient_id','medicine_id'
    ];


    public function medicine(){
        return $this->belongsTo('App\Medicine');
    }

    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
