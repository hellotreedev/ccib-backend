<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class ContactSetting extends Model  implements TranslatableContract
{
    use SearchableTrait;
	use Translatable;

    protected $table = 'contact_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['image_full_path', 'phone_icon_full_path', 'fax_icon_full_path', 'mail_icon_full_path', 'call_center_icon_full_path'];

    public $translatedAttributes = ["phone_text","fax_text","ext_text","president_number_text","director_number_text","po_box_text","location_text","president_title","director_title","po_box_title","location_title","contact_details_title","form_title","form_subtitle","fname_placeholder","lname_placeholder","mail_placeholder","number_placeholder","message_placeholder","success_text","error_text","send_btn", "title"];

    protected $searchable = [
        'columns' => [
            'contact_settings_translations.title' => 10,
            'contact_settings_translations.contact_details_title' => 10,
            'contact_settings_translations.president_title' => 10,
            'contact_settings_translations.director_title' => 10,
            'contact_settings_translations.po_box_title' => 10,
            'contact_settings_translations.location_title' => 10,
            'contact_settings_translations.contact_details_title' => 10,
        ],
        'joins' => [
            'contact_settings_translations' => ['contact_settings_translations.contact_setting_id','contact_settings.id'],
        ],
    ];

    public function getImageFullPathAttribute()
    {
        if (isset($this->image)) {
            $full_path_image = Helper::fullPath($this->image);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getPhoneIconFullPathAttribute()
    {
        if (isset($this->phone_icon)) {
            $full_path_image = Helper::fullPath($this->phone_icon);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getFaxIconFullPathAttribute()
    {
        if (isset($this->fax_icon)) {
            $full_path_image = Helper::fullPath($this->fax_icon);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getMailIconFullPathAttribute()
    {
        if (isset($this->mail_icon)) {
            $full_path_image = Helper::fullPath($this->mail_icon);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getCallCenterIconFullPathAttribute()
    {
        if (isset($this->call_center_icon)) {
            $full_path_image = Helper::fullPath($this->call_center_icon);
            return $full_path_image;
        } else {
            return null;
        }
    }
	
		public function pages() { return $this->belongsTo('App\Page'); } 
 

	
}