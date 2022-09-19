<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class EService extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'e_services';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['side_menu_icon_full_path'];

    public function getSideMenuIconFullPathAttribute()
    {
        if (isset($this->side_menu_icon)) {
            $side_menu_icon_full_path = Helper::fullPath($this->side_menu_icon);
            return $side_menu_icon_full_path;
        } else {
            return null;
        }
    }


    public $translatedAttributes = ["title", "excerpt", "description", "terms_text", "benefits_text", "documents_text", "fees_text", "label"];

	
}