<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class WebsiteSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'website_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['hotline_logo_full_path'];

    public $translatedAttributes = ["enter_email_placeholder","subscribe_text","follow_us","rights","hotline_text", "search_here", "search_btn", "search_results", "no_results"];

    public function getHotlineLogoFullPathAttribute(){
        $hotline_logo_full_path = Helper::fullPath($this->hotline_logo);

        return $hotline_logo_full_path;
    }
	
}