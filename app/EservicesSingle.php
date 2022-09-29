<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class EservicesSingle extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'eservices_single';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["title","subtitle","section1_title","section1_excerpt","section1_btn","section2_content","section3_title","section4_content","section5_content","download_btn"];

	public function boxes() { return $this->belongsToMany('App\EservicesBox', 'eservices_box_eservices_single', 'eservices_single_id', 'eservices_box_id')->orderBy('eservices_box_eservices_single.ht_pos'); } 
	
	public function e_services() { return $this->belongsTo('App\EService'); }
}