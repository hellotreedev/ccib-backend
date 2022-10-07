<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class NewsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'news_settings';

    protected $guarded = ['id'];

    public $appends = ["download_icon_full_path"];

    public $translatedAttributes = ["page_title","search_placeholder","search_btn","year_placeholder","category_placeholder","learn_more","gallery_title","pdf_label"];

    public $hidden = ['translations'];

    
    public function getDownloadIconFullPathAttribute() {
        $download_icon_full_path = Helper::fullPath($this->download_icon);

        return $download_icon_full_path;
    }

    
	
}