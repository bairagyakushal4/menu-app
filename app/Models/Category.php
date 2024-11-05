<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';

    // Mutator for category_name
    public function setCategoryNameAttribute($val)
    {
        $this->attributes['category_name'] = ucfirst($val);
    }
}
