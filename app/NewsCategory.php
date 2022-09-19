<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class NewsCategory extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'news_categories';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["title"];

	public function category_news() { return $this->belongsToMany('App\NewsList', 'news_category_news_list',  'news_category_id', 'news_list_id',)->orderBy('news_category_news_list.ht_pos'); }

	
}