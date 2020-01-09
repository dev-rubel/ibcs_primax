<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disiplinary extends Model
{
    protected $table = 'disiplinaries';

    protected $fillable = [
        'go_date',
        'offence',
        'nature_of_punishment',
        'punishment_line_1',
        'punishment_line_2',
        'remarks'
    ];
}
