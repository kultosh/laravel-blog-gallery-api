<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function blogCategories()
    {
       return $this->hasOne(BlogCategory::class, 'blogs_id', 'id');
    }
}
