<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ProjectArticle extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'project_articles';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["title","download_pdf","pdf"];

    public $appends = ['pdf_full_path'];

    public function getPdfFullPathAttribute() {
        if (isset($this->pdf)) {
            $pdf_full_path = Helper::fullPath($this->pdf);
            return $pdf_full_path;
        } else {
            return null;
        }
    }

	public function projects() { return $this->belongsToMany('App\Project', 'project_project_article', 'project_article_id', 'project_id')->orderBy('project_project_article.ht_pos'); } 
}