<?php

namespace Lynx\System\Debug;

class Debugger {

    public static function dd()
    {
        echo '<style>
            body {
                background: #601831;
            } 
            .sfdump {
                background: #000;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                font-family: Consolas, monospace;
                font-size: 14px;
                line-height: 1.4;
                margin: 20px auto;
                max-width: 100%;
                overflow: auto;
                padding: 10px;
                position: relative;
                text-align: left;
                color: white;
                z-index: 9999;
            }
            .sfdump .sfdump-header {
                background: #dd2d20;
                border-bottom: 1px solid #ccc;
                border-radius: 5px 5px 0 0;
                color: #fff;
                font-size: 14px;
                font-weight: bold;
                padding: 5px 10px;
            }
            .sfdump .sfdump-body {
                padding: 10px;
            }
            .sfdump .sfdump-body .sfdump-array {
                margin: 0 0 10px 0;
            }
            .sfdump .sfdump-body .sfdump-array .sfdump-array-key {
                color: #333;
                font-weight: bold;
                margin-right: 5px;
            }
            .sfdump .sfdump-body .sfdump-array .sfdump-array-value {
                color: #333;
            }
            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array {
                margin: 0;
            }
            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-key {
                color: #333;
                font-weight: bold;
                margin-right: 5px;
            }
            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value {
                color: #333;
            }
            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array {
                margin: 0;
            }
            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-key {
                color: #333;
                font-weight: bold;
                margin-right: 5px;
            }

            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value {
                color: #333;
            }


            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array {
                margin: 0;
            }


            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-key {
                color: #333;
                font-weight: bold;
                margin-right: 5px;
            }


            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value {
                color: #333;
            }


            .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array {
                margin: 0;
            }




        </style>';


        echo '<div class="sfdump">';
        echo '<div class="sfdump-header">Dump</div>';
        echo '<div class="sfdump-body">';
        echo '<pre>';
        print_r(func_get_args());
        echo '</pre>';
        echo '</div>';
        echo '</div>';

        echo '<div class="sfdump">';
        echo '<div class="sfdump-header">Debug</div>';
        echo '<div class="sfdump-body">';
        echo '<pre>';
        $debug = debug_backtrace();
        $file = $debug[0]['file'];
        $line = $debug[0]['line'];
        $memory = memory_get_usage();
        $memory_peak = memory_get_peak_usage();
        $memory = formatBytes($memory);
        $memory_peak = formatBytes($memory_peak);
        $time = date('Y-m-d H:i:s');    
        echo "<b>Debug:</b> {$time} <br>";
        echo "<b>File:</b> {$file} <br>";
        echo "<b>Line:</b> {$line} <br>";
        echo "<b>Memory:</b> {$memory} <br>";
        echo 'Memory Usage: ' . memory_get_usage() . ' bytes <br>';
        echo "<b>Memory Peak:</b> {$memory_peak} <br>";
        echo '</pre>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="sfdump">';
        echo '<div class="sfdump-header">Lynx Info</div>';
        echo '<div class="sfdump-body">';
        echo '<pre>';
        echo "<b>Lynx Version:</b> ".LYNX_VERSION." <br>";
        echo "<b>Lynx Locale:</b> ". $_SESSION['appLocale'] ." <br>";
        echo "<b>PHP Version:</b> ".PHP_VERSION." <br>";
        echo "<b>Windows Version:</b> ".PHP_WINDOWS_VERSION_MAJOR." <br>";
        echo "<b>IP Address:</b> ".$_SERVER['REMOTE_ADDR']." <br>";
        echo '</pre>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<script>
            document.addEventListener("DOMContentLoaded", function(event) {
                document.addEventListener("click", function(event) {
                    if (event.target.classList.contains("sfdump")) {
                        event.target.style.display = "none";
                    }
                });
            });
        </script>';


        die();


}

    public static function ddd() {
        $args = func_get_args();
        $debug = debug_backtrace();
        $file = $debug[0]['file'];
        $line = $debug[0]['line'];
        $memory = memory_get_usage();
        $memory_peak = memory_get_peak_usage();
        $memory = self::formatBytes($memory);
        $memory_peak = self::formatBytes($memory_peak);
        $time = date('Y-m-d H:i:s');    
        $output = "<pre style='background-color: #f5f5f5; border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
        $output .= "<b>Debug:</b> {$time} <br>";
        $output .= "<b>File:</b> {$file} <br>";
        $output .= "<b>Line:</b> {$line} <br>";
        $output .= "<b>Memory:</b> {$memory} <br>";
        $output .= "<b>Memory Peak:</b> {$memory_peak} <br>";
        $output .= "<b>Arguments:</b> <br>";
        $output .= print_r($args, true);
        $output .= "</pre>";
        echo $output;

    }

    public static function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow)); 

        return round($bytes, $precision) . ' ' . $units[$pow]; 
    }
    
}