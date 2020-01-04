<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo('App\ExpenseCategories', 'category_id', 'id');
    }
}
