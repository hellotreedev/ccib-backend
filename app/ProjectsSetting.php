<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProjectsSetting extends Model  implements TranslatableContract
{
	use Translatable;
    use SearchableTrait;

    protected $table = 'projects_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    protected $searchable = [
        'groupBy' => ['projects_settings.id'],
        'columns' => [
            'projects_settings_translations.page_title' => 10,
            'projects_settings_translations.ongoing_projects' => 10,
            'projects_settings_translations.previous_projects' => 10,
        ],
        'joins' => [
            'projects_settings_translations' => ['projects_settings_translations.projects_setting_id','projects_settings.id'],
        ],
    ];

    public $appends = ["phone_icon_full_path", "office_phone_icon_full_path", "ext_icon_full_path", "mail_icon_full_path", "download_icon_full_path", "contact_image_path"];

    public $translatedAttributes = ["page_title","ongoing_projects","previous_projects", "related_news", "view_all", "learn_more", "closed_label", "contact_title", "contact_subtitle", "contact_phone_label", "contact_us"];

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
    
    public function getContactImagePathAttribute(){
        {
            if (($this->contact_image)) {
                $mail_icon_full_path = Helper::fullPath($this->contact_image);
                return $mail_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getDownloadIconFullPathAttribute() {
        $download_icon_full_path = Helper::fullPath($this->download_icon);

        return $download_icon_full_path;
    }
	
		public function pages() { return $this->belongsTo('App\Page'); } 

}