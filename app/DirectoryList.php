<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class DirectoryList extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'directory_list';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title"];

	
}