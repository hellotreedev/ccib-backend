<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class MilestonesList extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'milestones_list';

    protected $guarded = ['id'];

    public $translatedAttributes = ["date_title","description"];

	
}