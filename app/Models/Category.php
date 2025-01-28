<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;


    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'category_description',
        'category_logo',
        'category_status',
        'parent_category_id',
    ];

    // Mutator for category_name
    public function setCategoryNameAttribute($val)
    {
        $this->attributes['category_name'] = ucfirst($val);
    }
}
