<?php

namespace Lynx\System\Localization;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Session\Session;
use Lynx\System\File\File;

class Lang {

    public static function setAppLocale($languageName)
    {

        if ($languageName !== null) {
            if (File::exists(app_path('Localization/' . $languageName . ".json")) == 1) {
                Session::set('appLocale', $languageName);
            } else {
                return new ApplicationException("Language file not found","Lynx/System/Exception/LocalizationException.php", 404);
            }    
        } else {
            return new ApplicationException("Language file is not defined","Lynx/System/Exception/LocalizationException.php", 328);
        }
    }

    public static function get($key)
    {
        if ($key !== null) {
            if (Session::get('appLocale') !== null) {               
                $languageFile = Session::get('appLocale') . ".json";
                if (File::exists(app_path('Localization/' . $languageFile)) == 1) {
                    $languageFile = File::read(app_path('Localization/' . $languageFile));
                    $languageFile = json_decode($languageFile, true);
                    if (array_key_exists($key, $languageFile)) {
                        return $languageFile[$key];
                    } else {
                        return new ApplicationException("Key not found","Lynx/System/Exception/LocalizationException.php", 404);
                    }
                } else {
                    return new ApplicationException("Language file not found","Lynx/System/Exception/LocalizationException.php", 404);
                }
            } else {
                return new ApplicationException("Language file is not defined","Lynx/System/Exception/LocalizationException.php", 328);
            }
        } else {
            return new ApplicationException("Key is not defined","Lynx/System/Exception/LocalizationException.php", 328);
        }
    }

}
