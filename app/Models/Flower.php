<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    protected $table = 'flower';

    protected $primaryKey = 'id';

    protected $fillable = [
        'flower_name', 'picture', 'character', 'meaning', 'details',
    ];
}
