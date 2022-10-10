<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class DirectoryList extends Model  implements TranslatableContract
{
	use Translatable;
    use SearchableTrait;

    protected $table = 'directory_list';

    protected $guarded = ['id'];
    
    protected $hidden = ['translations'];

    protected $searchable = [
        'groupBy' => ['directory_list.id'],
        'columns' => [
            'directory_list_translations.title' => 10,
            'directory_list_translations.description' => 10,
        ],
        'joins' => [
            'directory_list_translations' => ['directory_list_translations.directory_list_id','directory_list.id'],
        ],
    ];

    public $translatedAttributes = ["title", "description"];

    public function member() { return $this->belongsToMany('App\ActivityMember', 'directory_list_activity_member', 'directory_list_id' , 'activity_member_id')->orderBy('directory_list_activity_member.ht_pos'); }
	
	public function pages() { return $this->belongsTo('App\Page'); } 

}