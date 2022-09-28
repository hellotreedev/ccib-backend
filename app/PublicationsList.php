<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Nicolaslopezj\Searchable\SearchableTrait;
use Astrotomic\Translatable\Translatable;

class PublicationsList extends Model  implements TranslatableContract
{
    use SearchableTrait;
    use Translatable;

    protected $table = 'publications_list';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['pdf_full_path', 'formatted_date'];

        public $translatedAttributes = ["title","excerpt","download_pdf","download_pdf_ar","pdf_en","pdf_ar"];



    protected $searchable = [
        'columns' => [
            'publications_list_translations.title' => 10,
            'publications_list_translations.excerpt' => 8,
            'publications_list.date' => 5,
        ],
        'joins' => [
            'publications_list_translations' => ['publications_list_translations.publications_list_id','publications_list.id'],
        ],
    ];

    public function getFormattedDateAttribute()
    {
        $months = [];

        if (request('locale') == 'ar') {
            $months = [
                "يناير",
                "فبراير",
                "مارس",
                "أبريل",
                "مايو",
                "يونيو",
                "يوليو",
                "أغسطس",
                "سبتمبر",
                "أكتوبر",
                "نوفمبر",
                "ديسمبر",
            ];
        } else {
            $months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];
        }

        $day = date('d', strtotime($this->date));
        $month = date('n', strtotime($this->date));
        $year = date('Y', strtotime($this->date));
        $month_string = $months[$month - 1];

        return "$day $month_string $year";
    }

    public function getPdfFullPathAttribute()
    {
        if (isset($this->pdf)) {
            $full_path_pdf = Helper::fullPath($this->pdf);
            return $full_path_pdf;
        } else {
            return null;
        }
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_publications_list', 'publications_list_id', 'category_id')->orderBy('category_publications_list.ht_pos');
    }
}
