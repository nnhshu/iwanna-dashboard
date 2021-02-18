<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";
    protected $fillable = [
        'title',
        'avatar',
        'slug',
        'categories_id',
        'content',
        'status'
    ];

    public function category(){
    	return $this->belongsTo('App\Models\Categories', 'categories_id', 'id');
    }

}
