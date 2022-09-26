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

    protected $appends = ['image_full_path', 'beneficiary_image_full_path', 'disclaimer_image_1_full_path', 'disclaimer_image_2_full_path', 'pdf_full_path', "phone_icon_full_path", "office_phone_icon_full_path", "ext_icon_full_path", "mail_icon_full_path", "download_icon_full_path",];

    public $translatedAttributes = ["title","subtitle","single_page_title","brief_title","brief_description","partners_title","strategic_title","benef_title","benef_description","objectives_title","objectives_description","action_title","action_description","budget_title","budget_description","activities_title","disclaimer_left","disclaimer_right","related_articles_title","pdf","phone_text", "office_phone_text", "ext_text", "download_pdf_text"];



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
    
    public function getPhoneIconFullPathAttribute(){
        {
            if (isset($this->phone_icon)) {
                $phone_icon_full_path = Helper::fullPath($this->phone_icon);
                return $phone_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getOfficePhoneIconFullPathAttribute(){
        {
            if (isset($this->office_phone_icon)) {
                $office_phone_icon_full_path = Helper::fullPath($this->office_phone_icon);
                return $office_phone_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getExtIconFullPathAttribute(){
        {
            if (isset($this->ext_icon)) {
                $ext_icon_full_path = Helper::fullPath($this->ext_icon);
                return $ext_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getMailIconFullPathAttribute(){
        {
            if (isset($this->mail_icon)) {
                $mail_icon_full_path = Helper::fullPath($this->mail_icon);
                return $mail_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getDownloadIconFullPathAttribute(){
        {
            if (isset($this->download_icon)) {
                $download_icon_full_path = Helper::fullPath($this->download_icon);
                return $download_icon_full_path;
            } else {
                return null;
            }
        }
    }
    

	public function project_categories() { return $this->belongsToMany('App\ProjectCategory', 'project_category_project', 'project_id', 'project_category_id')->orderBy('project_category_project.ht_pos'); } 
    public function partners() { return $this->belongsToMany('App\ProjectPartner', 'project_project_partner', 'project_id', 'project_partner_id')->orderBy('project_project_partner.ht_pos'); }
	public function associates() { return $this->belongsToMany('App\ProjectAssociate', 'project_project_associate', 'project_id', 'project_associate_id')->orderBy('project_project_associate.ht_pos'); } 
	public function activity() { return $this->belongsToMany('App\ProjectActivity', 'project_project_activity', 'project_id' , 'project_activity_id')->orderBy('project_project_activity.ht_pos'); } 
	public function articles() { return $this->belongsToMany('App\ProjectArticle', 'project_project_article', 'project_id')->orderBy('project_project_article.ht_pos'); } 

}