<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Support\Facades\Storage;


class NewsList extends Model  implements TranslatableContract
{
    use Translatable;
    use SearchableTrait;


    protected $table = 'news_list';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["title", "excerpt", "news_title", "single_page_pdf", "description", "share", "read_more", "left_text", "right_text"];

    protected $appends = ['display_title' ,'display_description', 'formatted_date', 'image_full_path', 'single_page_image_full_path', 'right_image_full_path', 'left_image_full_path', 'pdf_full_path', 'gallery_full_path'];

    protected $searchable = [
        'groupBy' => ['news_list.id'],
        'columns' => [
            'news_list_translations.title' => 10,
            'news_list_translations.excerpt' => 10,
            'news_list.date' => 6,
        ],
        'joins' => [
            'news_list_translations' => ['news_list.id', 'news_list_translations.news_list_id'],
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
    
    public function getDisplayDescriptionAttribute() {
        $desc = $this->description;
        
        if($this->isArabic){
            $desc = $this->translate('ar')->description;
        }
        
        return $desc;
    }
    
    public function getDisplayTitleAttribute() {
        $title = $this->title;
        
        if($this->isArabic){
            $title = $this->translate('ar')->title;
        }
        
        return $title;
    }

    public function getPdfFullPathAttribute()
    {
        $pdf_full_path = Helper::fullPath($this->single_page_pdf);

        return $pdf_full_path;
    }

    public function getGalleryFullPathAttribute()
    {

        if (isset($this->gallery)) {
            $array = json_decode($this->gallery, TRUE);
            $images = [];
            foreach ($array as $singleImage) {
                $images[] = Storage::url($singleImage);
            }
            return $images;
        } else {
            return null;
        }
    }


    public function getImageFullPathAttribute()
    {
        $full_path_image = Helper::fullPath($this->image);

        return $full_path_image;
    }

    public function getSinglePageImageFullPathAttribute()
    {
        $full_path_image = Helper::fullPath($this->image);

        return $full_path_image;
    }

    public function getRightImageFullPathAttribute()
    {
        $full_path_image = Helper::fullPath($this->image);

        return $full_path_image;
    }

    public function getLeftImageFullPathAttribute()
    {
        $full_path_image = Helper::fullPath($this->image);

        return $full_path_image;
    }

    public function related_news()
    {
        return $this->belongsToMany('App\NewsList', 'related_news_news_list', 'news_list_id', 'other_news_list_id')->orderBy('related_news_news_list.ht_pos');
    }
    public function news_categories()
    {
        return $this->belongsToMany('App\NewsCategory', 'news_category_news_list', 'news_list_id', 'news_category_id')->orderBy('news_category_news_list.ht_pos');
    }
}
