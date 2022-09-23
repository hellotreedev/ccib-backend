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


    public $translatedAttributes = ["title", "excerpt", "description", "terms_text", "benefits_text", "documents_text", "fees_text", "label", 'section1_title', 'section1_text', 'section2_content',  'section3_title', 'section3_subtitle', 'section4_content','section5_content', 'download_btn', 'btn_pdf', 'btn_url'];

		public function boxes() { return $this->belongsToMany('App\EservicesBox', 'eservices_box_e_service', 'e_service_id', 'eservices_box_id')->orderBy('eservices_box_e_service.ht_pos'); } 

}