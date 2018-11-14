<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table = "relationships";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','patient_id'
    ];

    public static function getPatients($user_id) {

        $relationship = Relationship::where('user_id', $user_id)->get();

        $patients = [];

        foreach ($relationship as $item) {
            array_push($patients, Patient::find($item->patient_id));
        }

        return $patients;
    }
}
