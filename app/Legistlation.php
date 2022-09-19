<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Legistlation extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'legistlation';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];


    public $translatedAttributes = ["page_title","section_title","section_description","perform_transactions","transactions_pdf","contact_title"];

	public function e_services() { return $this->belongsToMany('App\EService', 'e_service_legistlation', 'legistlation_id', 'e_service_id')->orderBy('e_service_legistlation.ht_pos'); } 
}