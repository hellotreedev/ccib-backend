<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Project extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'projects';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    protected $appends = ['image_full_path', 'beneficiary_image_full_path', 'disclaimer_image_1_full_path', 'disclaimer_image_2_full_path', 'pdf_full_path'];

    public $translatedAttributes = ["title","subtitle","contact_label","single_page_title","brief_title","brief_description","partners_title","strategic_title","benef_title","benef_description","objectives_title","objectives_description","action_title","action_description","budget_title","budget_description","activities_title","disclaimer_left","disclaimer_right","related_articles_title","pdf","phone_text", "office_phone_text", "ext_text", "download_pdf_text", "disclaimer_title"];



    public function getImageFullPathAttribute() {
        if (isset($this->image)) {
            $full_path_image = Helper::fullPath($this->image);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getBeneficiaryImageFullPathAttribute() {
        if (isset($this->beneficiary_image)) {
            $beneficiary_image_full_path = Helper::fullPath($this->beneficiary_image);
            return $beneficiary_image_full_path;
        } else {
            return null;
        }
    }

    public function getDisclaimerImage1FullPathAttribute() {
        if (isset($this->disclaimer_image_1)) {
            $disclaimer_image_1_full_path = Helper::fullPath($this->disclaimer_image_1);
            return $disclaimer_image_1_full_path;
        } else {
            return null;
        }
    }

    public function getDisclaimerImage2FullPathAttribute() {
        if (isset($this->disclaimer_image_2)) {
            $disclaimer_image_2_full_path = Helper::fullPath($this->disclaimer_image_2);
            return $disclaimer_image_2_full_path;
        } else {
            return null;
        }
    }

    public function getPdfFullPathAttribute() {
        if (isset($this->pdf)) {
            $pdf_full_path = Helper::fullPath($this->pdf);
            return $pdf_full_path;
        } else {
            return null;
        }
    }
    

	public function project_categories() { return $this->belongsToMany('App\ProjectCategory', 'project_category_project', 'project_id', 'project_category_id')->orderBy('project_category_project.ht_pos'); } 
    public function partners() { return $this->belongsToMany('App\ProjectPartner', 'project_project_partner', 'project_id', 'project_partner_id')->orderBy('project_project_partner.ht_pos'); }
	public function associates() { return $this->belongsToMany('App\ProjectAssociate', 'project_project_associate', 'project_id', 'project_associate_id')->orderBy('project_project_associate.ht_pos'); } 
	public function activity() { return $this->belongsToMany('App\ProjectActivity', 'project_project_activity', 'project_id' , 'project_activity_id')->orderBy('project_project_activity.ht_pos'); } 
	public function articles() { return $this->belongsToMany('App\ProjectArticle', 'project_project_article', 'project_id')->orderBy('project_project_article.ht_pos'); }
	public function news() { return $this->belongsToMany('App\NewsList', 'news_project', 'project_id', 'news_list_id')->orderBy('news_project.ht_pos'); } 
	public function events() { return $this->belongsToMany('App\Event', 'event_project', 'project_id', 'event_id')->orderBy('event_project.ht_pos'); } 
    public function news_categories() { return $this->belongsTo('App\NewsCategory'); }
}