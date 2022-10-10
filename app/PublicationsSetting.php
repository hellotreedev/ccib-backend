<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class PublicationsSetting extends Model  implements TranslatableContract
{
    use SearchableTrait;
	use Translatable;

    protected $table = 'publications_settings';

    protected $guarded = ['id'];

    protected $searchable = [
        'groupBy' => ['publications_settings.id'],
        'columns' => [
            'publications_settings_translations.page_title' => 10,
            'publications_settings_translations.categories_title' => 10,
        ],
        'joins' => [
            'publications_settings_translations' => ['publications_settings_translations.publications_setting_id','publications_settings.id'],
        ],
    ];

    public $translatedAttributes = ["page_title","categories_title","view_pdf"];

	public function pages() { return $this->belongsTo('App\Page'); } 
}