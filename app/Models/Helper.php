<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    protected $table = 'helpers';
    protected $primaryKey = 'helper_id';
    protected $guarded = [];
}
