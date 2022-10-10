<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class BoardOfDirectorsSetting extends Model  implements TranslatableContract
{
    use SearchableTrait;
	use Translatable;

    protected $table = 'board_of_directors_settings';

    protected $guarded = ['id'];

    protected $searchable = [
        'groupBy' => ['board_of_directors_settings.id'],
        'columns' => [
            'board_of_directors_settings_translations.page_title' => 10,
        ],
        'joins' => [
            'board_of_directors_settings_translations' => ['board_of_directors_settings_translations.board_of_directors_setting_id','board_of_directors_settings.id'],
        ],
    ];

    public $translatedAttributes = ["page_title"];

	public function pages() { return $this->belongsTo('App\Page'); } 
}