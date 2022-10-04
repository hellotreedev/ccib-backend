<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class EservicesSingle extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'eservices_single';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['btn_pdf_full_path', 'pdf_full_path'];

    public $translatedAttributes = ["title","subtitle","section1_title","section1_excerpt","section1_btn","section2_content","section3_title","section3_subtitle","section4_content","section5_content","download_btn", "pdf"];

    public function getBtnPdfFullPathAttribute()
    {
        if (isset($this->download_btn_pdf)) {
            $download_btn_pdf_full_path = Helper::fullPath($this->download_btn_pdf);
            return $download_btn_pdf_full_path;
        } else {
            return null;
        }
    }

    public function getPdfFullPathAttribute()
    {
        if (isset($this->pdf)) {
            $pdf_full_path = Helper::fullPath($this->pdf);
            return $pdf_full_path;
        } else {
            return null;
        }
    }

	public function boxes() { return $this->belongsToMany('App\EservicesBox', 'eservices_box_eservices_single', 'eservices_single_id', 'eservices_box_id')->orderBy('eservices_box_eservices_single.ht_pos'); } 
	
	public function e_services() { return $this->belongsTo('App\EService'); }
}