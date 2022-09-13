<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class RennovationSponsorsList extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'rennovation_sponsors_list';

    protected $guarded = ['id'];

    public $translatedAttributes = ["name","company"];

	public function sponsor_level() { return $this->belongsTo('App\SponsorLevel'); } 
}