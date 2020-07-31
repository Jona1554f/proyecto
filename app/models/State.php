<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class State extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql-ignug';
    public $timestamps = false;
    protected $fillable = [
        'code',
        'name',
        'state',
    ];

    public function institution()
    {
        return $this->hasMany(Institution::class);
    }
}
