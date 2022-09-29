<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class SectorOfActivity extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'sector_of_activity';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["title"];

    
        public function members_of_activity() { return $this->belongsToMany('App\ActivityMember', 'sector_of_activity_activity_member', 'sector_of_activity_id' , 'activity_member_id')->orderBy('sector_of_activity_activity_member.ht_pos'); }

    
	
}