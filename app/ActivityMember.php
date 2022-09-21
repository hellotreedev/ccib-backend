<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ActivityMember extends Model  implements TranslatableContract
{
    use Translatable;

    protected $table = 'activity_members';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['image_full_path'];

    public function getImageFullPathAttribute()
    {
        if (isset($this->image)) {
            $full_path_image = Helper::fullPath($this->image);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public $translatedAttributes = ["title", "learn_more", "popup_description", "contact", "phone1_text", "phone2_text", "phone3_text", "fax_text", "location_text"];

    public function sector_of_activity()
    {
        return $this->belongsTo('App\SectorOfActivity');
    }
    public function activity()
    {
        return $this->belongsToMany('App\Activity', 'activity_activity_member', 'activity_member_id', 'activity_id')->orderBy('activity_activity_member.ht_pos');
    }
    public function directory()
    {
        return $this->belongsToMany('App\DirectoryList', 'directory_list_activity_member', 'activity_member_id', 'directory_list_id')->orderBy('directory_list_activity_member.ht_pos');
    }
}
