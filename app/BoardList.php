<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class BoardList extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'board_list';

    protected $guarded = ['id'];

    public $translatedAttributes = ["name","position","excerpt","phone_text","fax_text"];

	public function department() { return $this->belongsTo('App\Department'); } 
}