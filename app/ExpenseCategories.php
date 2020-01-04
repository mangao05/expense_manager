<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategories extends Model
{
    protected $guarded = ['id'];

    public function expenses()
    {
        return $this->hasMany('App\Expenses', 'category_id', 'id');
    }
}
