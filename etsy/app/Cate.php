<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'cates';

    protected $fillable = ['category_name'];

    public function cateListing() {
    	return $this->hasMany('App\Listing', 'category_id', 'id');
    }
}
