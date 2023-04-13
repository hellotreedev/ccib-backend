<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Test extends Model 
{
	

    protected $table = 'tests';

    protected $guarded = ['id'];

    

	public function category() { return $this->belongsTo('App\NewsCategory'); } 
}