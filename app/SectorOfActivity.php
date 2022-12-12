<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class SectorOfActivity extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'sector_of_activity';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["title"];

	public function directory() { return $this->belongsToMany('App\DirectoryList', 'directory_sector_of_activity', 'sector_of_activity_id', 'directory_list_id')->orderBy('directory_sector_of_activity.ht_pos'); } 
}