<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class EService extends Model  implements TranslatableContract
{
    use Translatable;

    protected $table = 'e_services';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title", "excerpt", "description", "btn_label"];

    protected $hidden = ['translations'];

    public $appends = ['side_menu_icon_full_path', 'icon_full_path'];

    public function getSideMenuIconFullPathAttribute()
    {
        if (isset($this->side_menu_icon)) {
            $side_menu_icon_full_path = Helper::fullPath($this->side_menu_icon);
            return $side_menu_icon_full_path;
        } else {
            return null;
        }
    }

    public function getIconFullPathAttribute()
    {
        if (isset($this->icon)) {
            $icon_full_path = Helper::fullPath($this->icon);
            return $icon_full_path;
        } else {
            return null;
        }
    }

    public function single_service()
    {
        return $this->hasMany('App\EservicesSingle', 'e_services_id');
    }
}
