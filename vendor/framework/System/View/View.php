<?php

namespace Lynx\System\View;

use Lynx\System\Exception\LynxException;

class View {

    public static function render($view, $data = array())
    {
        $this_view = str_replace('\\', '/', app_path()) . 'Views/' . str_replace('.', '/', $view) . '.lynx.php';

        if (file_exists($this_view)) {
            extract($data);
            require_once $this_view;
        } else {
            throw new LynxException("$view View not found.","Lynx/Component/AccessException",707);
        }
    }

    public static function collection($views, $data = array())
    {
        $views = is_array($views) ? $views : [$views];
        $exists = true;

        foreach ($views as $view) {
            $this_view = str_replace('\\', '/', app_path()) . 'Views/' . str_replace('.', '/', $view) . '.lynx.php';
            if (!($exists && file_exists($this_view))) {
                throw new LynxException("$view View not found.","Lynx/Component/AccessException",707);  
            }
        }

        extract($data);
        foreach ($views as $view) { 
            require_once str_replace('\\', '/', app_path()) . 'Views/' . str_replace('.', '/', $view) . '.lynx.php';
        }
    }

    public static function compact($data = []){
        extract($data);
    }

}