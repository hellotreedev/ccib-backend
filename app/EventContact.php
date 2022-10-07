<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class EventContact extends Model 
{
	

    protected $table = 'event_contact';

    protected $guarded = ['id'];

    

	public function events() { return $this->belongsTo('App\Event'); } 
}