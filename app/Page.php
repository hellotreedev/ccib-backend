<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Page extends Model  implements TranslatableContract
{
	use Translatable;
    use SearchableTrait;

    protected $table = 'pages';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title","text"];
    
    protected $hidden = ['translations'];
    
    protected $searchable = [
        'groupBy' => ['pages.id'],
        'columns' => [
            'pages_translations.title' => 10,
        ],
        'joins' => [
            'pages_translations' => ['pages_translations.page_id','pages.id'],
        ],
    ];
	
}