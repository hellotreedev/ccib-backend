<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;


class Page extends Model  implements TranslatableContract
{
	use Translatable;
    use SearchableTrait;
    
    
    protected $table = 'Pages';
    
    protected $guarded = ['id'];
    
    public $translatedAttributes = ["title", "text"];

    protected $hidden = ['translations'];
    
    protected $searchable = [
        'columns' => [
            'Pages_translations.title' => 10,
            'Pages_translations.text' => 8,
        ],
        'joins' => [
            'Pages_translations' => ['Pages_translations.Page_id','Pages.id'],
        ],
    ];
	
}