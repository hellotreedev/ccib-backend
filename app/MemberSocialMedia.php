<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;


class MemberSocialMedia extends Model 
{
	

    protected $table = 'member_social_media';

    protected $guarded = ['id'];

    public $appends = ['icon_full_path'];

    public function getIconFullPathAttribute() {
        {
            if (isset($this->icon)) {
                $icon_full_path = Helper::fullPath($this->icon);
                return $icon_full_path;
            } else {
                return null;
            }
        }
    }

	public function activity_members() { return $this->belongsTo('App\ActivityMember')->orderBy('ht_pos'); } 
}