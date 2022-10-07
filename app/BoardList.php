<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;


class BoardList extends Model  implements TranslatableContract
{
    use SearchableTrait;
	use Translatable;

    protected $table = 'board_list';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    protected $searchable = [
        'groupBy' => ['board_list.id'],
        'columns' => [
            'board_list_translations.name' => 10,
            'board_list_translations.position' => 6,
        ],
        'joins' => [
            'board_list_translations' => ['board_list_translations.board_list_id','board_list.id'],
        ],
    ];

    public $translatedAttributes = ["name","position","excerpt","phone_text","fax_text"];

	public function department() { return $this->belongsTo('App\Department'); } 
}