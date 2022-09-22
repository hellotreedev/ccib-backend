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

<<<<<<< HEAD
    public function members_of_activity()
    {
        return $this->hasMany('App\ActivityMember', 'sector_of_activity_id');
    }
	
=======
	public function members_of_activity()
    {
        return $this->hasMany('App\ActivityMember', 'sector_of_activity_id');
    }
>>>>>>> 741554b3b49b626c57f818773a21ef404db5fd8b
}