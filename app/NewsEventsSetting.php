<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class NewsEventsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'news_events_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ["image_full_path"];

    public function getImageFullPathAttribute()
    {
        if (isset($this->newsletter_image)) {
            $full_path_image = Helper::fullPath($this->newsletter_image);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public $translatedAttributes = ["page_title","view_pdf","view_all","learn_more","publications_title","news_title","previous_title","upcoming_title","subcribe_to_letter","subscribe_excerpt","enter_email_placeholder","subscribe_btn", "events_title", "download_pdf"];

	
}