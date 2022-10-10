<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Directory extends Model  implements TranslatableContract
{
	use Translatable;
    use SearchableTrait;

    protected $table = 'directory';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    protected $searchable = [
        'groupBy' => ['directory.id'],
        'columns' => [
            'directory_translations.page_title' => 10,
            'directory_translations.section1_title' => 10,
            'directory_translations.section1_description' => 10,
            'directory_translations.section2_title' => 10,
        ],
        'joins' => [
            'directory_translations' => ['directory_translations.directory_id','directory.id'],
        ],
    ];

    public $appends = ['phone_icon_full_path', 'fax_icon_full_path', 'mail_icon_full_path', 'web_icon_full_path', 'loc_icon_full_path'];

    public $translatedAttributes = ["page_title","section1_title","section1_description","section2_title", "view_all"];

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

    public function getWebIconFullPathAttribute()
    {
        if (isset($this->web_icon)) {
            $web_icon_full_path = Helper::fullPath($this->web_icon);
            return $web_icon_full_path;
        } else {
            return null;
        }
    }

    public function getLocIconFullPathAttribute()
    {
        if (isset($this->loc_icon)) {
            $loc_icon_full_path = Helper::fullPath($this->loc_icon);
            return $loc_icon_full_path;
        } else {
            return null;
        }
    }

	public function pages() { return $this->belongsTo('App\Page'); } 


    
}