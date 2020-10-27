<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpensesType extends Model
{
    protected $table = 'expense_types';
    protected $primaryKey = 'expense_type_id';
    protected $guarded = [];
}
