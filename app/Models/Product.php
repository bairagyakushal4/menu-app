<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    // Mutator for category_name
    public function setProductNameAttribute($val)
    {
        $this->attributes['product_name'] = ucfirst($val);
    }
}
