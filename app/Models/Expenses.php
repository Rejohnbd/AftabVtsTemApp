<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = 'expenses';
    protected $primaryKey = 'expense_id';
    protected $guarded = [];

    public function expensesType()
    {
        return $this->belongsTo(ExpensesType::class, 'expense_type_id', 'expense_type_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id', 'trip_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'expense_added_by', 'id');
    }
}
