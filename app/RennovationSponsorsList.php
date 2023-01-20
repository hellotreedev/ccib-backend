<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use App\Helpers\Helper;


class RennovationSponsorsList extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'rennovation_sponsors_list';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['logo_path'];

    public $translatedAttributes = ["name","company"];
    
    public function getLogoPathAttribute(){
        if($this->logo != "")
        return Helper::fullPath($this->logo);
        else
        return null;
    }

	public function sponsor_level() { return $this->belongsTo('App\SponsorLevel'); } 
}