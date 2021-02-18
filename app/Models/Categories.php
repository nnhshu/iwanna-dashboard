<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = "categories";
    protected $fillable = [
        'title',
        'description'
    ];
    public function article(){
    	return $this->hasMany('App\Models\Article', 'categories_id');
    }
}
