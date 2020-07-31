<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicFormation extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institution',
        'career',
        'professional_degree',
        'registration_date',
        'senescyt_code',
        'has_titling',
        'state',
    ];

    public function profsesional()
    {
        return $this->belongsTo('App\Professional');
    }

}
