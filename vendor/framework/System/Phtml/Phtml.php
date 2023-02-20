<?php

namespace Lynx\System\Phtml;

class Phtml {

    protected $html;
    protected $title;
    protected $style;
    protected $meta;
    protected $script;

    public static function html()
    {
        $html = `
        <!DOCTYPE html>
        <html lang="en">
        <body>
        </body>
        </html>
        `;

        return new static;
    }

    public function title($title = "")
    {
        $title = "<title> $title </title>";
    }

    public function meta($metas = [])
    {
        if(!empty($metas)) {

        } else {
            
        }
    }

    public function divs($attributes = [])
    {
        if (empty($attributes)) {

        }
    }

    public function dive()
    {

    }


}