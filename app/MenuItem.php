<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class MenuItem extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'menu_items';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];


    public $translatedAttributes = ["about","services","directory","arbitration","arbitration_url","contact","membership_legislation","internal_projects","news_events","membership_directory","coo_verification","membership_renewal","certificate_origin","new_membership","publications","news","events","GS1","GS1_url","chairman_letter","strategy_mission","milestones","chairmen","chambers_law","board_directors","our_sponsors", "membership"];

	
}