<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ServicesList extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'services_list';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ["image_full_path","gold_icon_full_path", "phone_icon_full_path", "fax_icon_full_path", "ext_icon_full_path", "mail_icon_full_path", "download_icon_full_path", "pdf_full_path"];
    
    public $translatedAttributes = ["title","excerpt","learn_more","single_page_title","about_title","about_description", "publications_title", "services_title", "pdf", "phone_text", "fax_text", "ext_text", "download_pdf"];

    public function getGoldIconFullPathAttribute(){
        {
            if (isset($this->gold_icon)) {
                $gold_icon_full_path = Helper::fullPath($this->gold_icon);
                return $gold_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getImageFullPathAttribute(){
        {
            if (isset($this->image)) {
                $image_full_path = Helper::fullPath($this->image);
                return $image_full_path;
            } else {
                return null;
            }
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

    public function getFaxIconFullPathAttribute(){
        {
            if (isset($this->fax_icon)) {
                $fax_icon_full_path = Helper::fullPath($this->fax_icon);
                return $fax_icon_full_path;
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

    public function getPdfFullPathAttribute(){
        {
            if (isset($this->pdf)) {
                $pdf_full_path = Helper::fullPath($this->pdf);
                return $pdf_full_path;
            } else {
                return null;
            }
        }
    }

	public function related_publications() { return $this->belongsToMany('App\PublicationsList', 'publications_list_services_list', 'services_list_id', 'publications_list_id')->orderBy('publications_list_services_list.ht_pos'); } public function related_services() { return $this->belongsToMany('App\ServicesList', 'services_list_services_list', 'services_list_id', 'other_services_list_id')->orderBy('services_list_services_list.ht_pos'); } 
}