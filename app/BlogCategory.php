<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}
