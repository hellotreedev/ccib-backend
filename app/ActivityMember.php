<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class ActivityMember extends Model  implements TranslatableContract
{
    use Translatable;
    use SearchableTrait;


    protected $table = 'activity_members';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['image_full_path'];

    protected $searchable = [
        'columns' => [
            'activity_members_translations.title' => 10,
        ],
        'joins' => [
            'activity_members_translations' => ['activity_members_translations.activity_member_id','activity_members.id'],
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

   


    public $translatedAttributes = ["title","description", "learn_more", "popup_description", "contact", "phone1_text", "phone2_text", "phone3_text", "fax_text", "location_text"];

    public function sector_of_activity() { return $this->belongsToMany('App\SectorOfActivity', 'sector_of_activity_activity_member', 'activity_member_id', 'sector_of_activity_id')->orderBy('sector_of_activity_activity_member.ht_pos'); }
    public function activity()
    {
        return $this->belongsToMany('App\Activity', 'activity_activity_member', 'activity_member_id', 'activity_id')->orderBy('activity_activity_member.ht_pos');
    }
    public function directory()
    {
        return $this->belongsToMany('App\DirectoryList', 'directory_list_activity_member', 'activity_member_id', 'directory_list_id')->orderBy('directory_list_activity_member.ht_pos');
    }
	
	public function members_option() { return $this->belongsTo('App\MembersOption'); }

    public function socials() { return $this->hasMany('App\MemberSocialMedia', 'activity_members_id')->orderBy('ht_pos'); } 
    
}
