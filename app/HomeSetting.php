<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class HomeSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'home_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['about_image_full_path','main_image_full_path', 'image1_full_path', 'image2_full_path', 'image3_full_path', 'image4_full_path', 'image5_full_path'];

    public function getMainImageFullPathAttribute()
    {
        if (isset($this->main_image)) {
            $full_path_image = Helper::fullPath($this->main_image);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getAboutImageFullPathAttribute()
    {
        if (isset($this->about_image)) {
            $full_path_image = Helper::fullPath($this->about_image);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getImage1FullPathAttribute()
    {
        if (isset($this->image1)) {
            $full_path_image = Helper::fullPath($this->image1);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getImage2FullPathAttribute()
    {
        if (isset($this->image2)) {
            $full_path_image = Helper::fullPath($this->image2);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getImage3FullPathAttribute()
    {
        if (isset($this->image3)) {
            $full_path_image = Helper::fullPath($this->image3);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getImage4FullPathAttribute()
    {
        if (isset($this->image4)) {
            $full_path_image = Helper::fullPath($this->image4);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getImage5FullPathAttribute()
    {
        if (isset($this->image5)) {
            $full_path_image = Helper::fullPath($this->image5);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public $translatedAttributes = ["about_title","about_description","read_more","news_events_title","view_all","services_title","publications_title","eservices_title","eservices_description","learn_more", "banner_title", "view_pdf"];
	public function home_news() { return $this->belongsToMany('App\NewsList', 'news_list_home_setting', 'home_setting_id', 'news_list_id')->orderBy('news_list_home_setting.ht_pos'); } public function home_events() { return $this->belongsToMany('App\Event', 'event_home_setting', 'home_setting_id', 'event_id')->orderBy('event_home_setting.ht_pos'); } 

}