<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class ChamberSetting extends Model  implements TranslatableContract
{
	use Translatable;
    use SearchableTrait;


    protected $table = 'chamber_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['pdf_full_path'];

    protected $searchable = [
        'groupBy' => ['chamber_settings.id'],
        'columns' => [
            'chamber_settings_translations.page_title' => 10,
            'chamber_settings_translations.page_subtitle' => 10,
            'chamber_settings_translations.subtitle' => 10,
        ],
        'joins' => [
            'chamber_settings_translations' => ['chamber_settings_translations.chamber_setting_id','chamber_settings.id'],
        ],
    ];

    public function getPdfFullPathAttribute()
    {
        if (isset($this->pdf)) {
            $full_path_pdf = Helper::fullPath($this->pdf);
            return $full_path_pdf;
        } else {
            return null;
        }
    }


    public $translatedAttributes = ["page_title","page_subtitle","title","subtitle","pdf", "download_pdf"];

	public function pages() { return $this->belongsTo('App\Page'); } 

	
}