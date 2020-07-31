<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class ProfessionalReference extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institution',
        'position',
        'contact',
        'phone',
        'state',
    ];

    public function profsesional()
    {
        return $this->belongsTo('App\Professional');
    }

}
