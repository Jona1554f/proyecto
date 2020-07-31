<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_type',
        'institution',
        'event_name',
        'start_date',
        'finish_date',
        'hours',
        'type_certification',
        'state',
    ];

    public function profsesional()
    {
        return $this->belongsTo('App\Professional');
    }

}
