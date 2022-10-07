<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ServicesSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'services_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ["phone_icon_full_path", "fax_icon_full_path", "ext_icon_full_path", "mail_icon_full_path", "download_icon_full_path"];

    public $translatedAttributes = ["page_title","e_services_title"];

	public function getPhoneIconFullPathAttribute()
    { {
            if (isset($this->phone_icon)) {
                $phone_icon_full_path = Helper::fullPath($this->phone_icon);
                return $phone_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getFaxIconFullPathAttribute()
    { {
            if (isset($this->fax_icon)) {
                $fax_icon_full_path = Helper::fullPath($this->fax_icon);
                return $fax_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getExtIconFullPathAttribute()
    { {
            if (isset($this->ext_icon)) {
                $ext_icon_full_path = Helper::fullPath($this->ext_icon);
                return $ext_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getMailIconFullPathAttribute()
    { {
            if (isset($this->mail_icon)) {
                $mail_icon_full_path = Helper::fullPath($this->mail_icon);
                return $mail_icon_full_path;
            } else {
                return null;
            }
        }
    }

    public function getDownloadIconFullPathAttribute()
    { {
            if (isset($this->download_icon)) {
                $download_icon_full_path = Helper::fullPath($this->download_icon);
                return $download_icon_full_path;
            } else {
                return null;
            }
        }
    }
}