<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Nicolaslopezj\Searchable\SearchableTrait;
use Astrotomic\Translatable\Translatable;

class ServicesList extends Model  implements TranslatableContract
{
    use SearchableTrait;
    use Translatable;

    protected $table = 'services_list';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    protected $searchable = [
        'groupBy' => ['services_list.id'],
        'columns' => [
            'services_list_translations.title' => 10,
            'services_list_translations.excerpt' => 10,
            'services_list_translations.single_page_title' => 10,
            'services_list_translations.about_title' => 10,
            'services_list_translations.about_description' => 10,
            'services_list_translations.publications_title' => 10,
            'services_list_translations.services_title' => 10,
            'services_list_translations.contact_us' => 10,
            'services_list_translations.different_section_description' => 10,
            'services_list_translations.different_perform_transactions' => 10,
            'services_list_translations.different_contact_title' => 10,
        ],
        'joins' => [
            'services_list_translations' => ['services_list_translations.services_list_id','services_list.id'],
        ],
    ];

    public $appends = ["image_full_path", "icon_full_path", "gold_icon_full_path", "pdf_full_path"];

    public $translatedAttributes = ["title", "excerpt", "learn_more", "single_page_title", "about_title", "about_description", "publications_title", "services_title", "contact_us_title", "pdf", "contact_us", "phone_text", "fax_text", "ext_text", "download_pdf", "different_section_image", "different_section_description", "different_perform_transactions", "different_transactions_pdf", "different_contact_title", "different_pdf_btn"];


    public function getIconFullPathAttribute()
    { {
            if (isset($this->icon)) {
                $icon_full_path = Helper::fullPath($this->icon);
                return $icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getGoldIconFullPathAttribute()
    { {
            if (isset($this->gold_icon)) {
                $gold_icon_full_path = Helper::fullPath($this->gold_icon);
                return $gold_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getImageFullPathAttribute()
    { {
            if (isset($this->image)) {
                $image_full_path = Helper::fullPath($this->image);
                return $image_full_path;
            } else {
                return null;
            }
        }
    }

    

    public function getPdfFullPathAttribute()
    { {
            if (isset($this->pdf)) {
                $pdf_full_path = Helper::fullPath($this->pdf);
                return $pdf_full_path;
            } else {
                return null;
            }
        }
    }

    public function related_publications()
    {
        return $this->belongsToMany('App\PublicationsList', 'publications_list_services_list', 'services_list_id', 'publications_list_id')->orderBy('publications_list_services_list.ht_pos');
    }
    public function related_services()
    {
        return $this->belongsToMany('App\ServicesList', 'services_list_services_list', 'services_list_id', 'other_services_list_id')->orderBy('services_list_services_list.ht_pos');
    }
    public function e_services()
    {
        return $this->belongsToMany('App\EService', 'e_service_services_list', 'services_list_id', 'e_service_id')->orderBy('e_service_services_list.ht_pos');
    }
    public function locations()
    {
        return $this->belongsToMany('App\Location', 'location_services_list', 'services_list_id', 'location_id')->orderBy('location_services_list.ht_pos');
    }
	public function pages() { return $this->belongsTo('App\Page'); }
}
