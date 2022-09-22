<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MemberSocialMedia extends Model 
{
	

    protected $table = 'member_social_media';

    protected $guarded = ['id'];

    

	public function activity_members() { return $this->belongsTo('App\ActivityMember'); } 
}