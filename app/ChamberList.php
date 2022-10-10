<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class ChamberList extends Model  implements TranslatableContract
{
    use SearchableTrait;
	use Translatable;

    

    protected $table = 'chamber_list';

    protected $searchable = [
        'groupBy' => ['chamber_list.id'],
        'columns' => [
            'chamber_list_translations.title' => 10,
            'chamber_list_translations.description' => 10,
        ],
        'joins' => [
            'chamber_list_translations' => ['chamber_list_translations.chamber_list_id','chamber_list.id'],
        ],
    ];

    protected $guarded = ['id'];

    public $translatedAttributes = ["title","description"];

	public function pages() { return $this->belongsTo('App\Page'); } 
}