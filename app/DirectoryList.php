<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class DirectoryList extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'directory_list';

    protected $guarded = ['id'];
    
    protected $hidden = ['translations'];


    public $translatedAttributes = ["title", "description"];

    public function member() { return $this->belongsToMany('App\ActivityMember', 'directory_list_activity_member', 'directory_list_id' , 'activity_member_id')->orderBy('directory_list_activity_member.ht_pos'); }
	
}