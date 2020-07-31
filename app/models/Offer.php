<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Offer extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'code',
        'contact',
        'email',
        'phone',
        'cell_phone',
        'contract_type',
        'position',
        'broad_field',
        'specific_field',
        'training_hours',
        'remuneration',
        'working_day',
        'number_jobs',
        'experience_time',
        'activities',
        'aditional_information',
        'start_date',
        'finish_date',
        'city',
        'province',
        'state',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function professionals()
    {
        return $this->belongsToMany('App\Professional')->withTimestamps();
    }


}
