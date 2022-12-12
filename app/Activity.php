<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Activity extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'activity';

    protected $guarded = ['id'];

    public $hidden = ['translations'];

    public $translatedAttributes = ["title"];

	public function sector_of_activity() { return $this->belongsToMany('App\SectorOfActivity', 'sector_of_activity_activity', 'activity_id', 'sector_of_activity_id')->orderBy('sector_of_activity_activity.ht_pos'); } 
}