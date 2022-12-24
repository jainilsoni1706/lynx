<?php

namespace Lynx\System\File;

use Lynx\System\Set\Set;
use Lynx\System\Exception\ApplicationException;

class File {
    
        public static function get($path)
        {
            if (file_exists($path)) {
                return file_get_contents($path);
            }
            return new ApplicationException("File not found: {$path}","Lynx/System/Exception/FileException.php",404);
        }
    
        public static function put($path, $content)
        {
            if (file_exists($path)) {
                return file_put_contents($path, $content);
            }
            return new ApplicationException("File not found: {$path}","Lynx/System/Exception/FileException.php",404);
        }
    
        public static function delete($path)
        {
            if (file_exists($path)) {
                return unlink($path);
            }   else {
                return new ApplicationException("File not found: {$path}","Lynx/System/Exception/FileException.php",404);
            }
        }

        public static function exists($path)
        {
            return file_exists($path);
        }

        public static function extension($path)
        {
            return pathinfo($path, PATHINFO_EXTENSION);
        }

        public static function name($path)
        {
            return pathinfo($path, PATHINFO_FILENAME);
        }

        public static function basename($path)
        {
            return pathinfo($path, PATHINFO_BASENAME);
        }

        public static function dirname($path)
        {
            return pathinfo($path, PATHINFO_DIRNAME);
        }

        public static function mimeType($path)
        {
            return mime_content_type($path);
        }

        public static function size($path)
        {
            return filesize($path);
        }

        public static function lastModified($path)
        {
            return filemtime($path);
        }

        public static function isDirectory($path)
        {
            return is_dir($path);
        }

        public static function isFile($path)
        {
            return is_file($path);
        }

        public static function isReadable($path)
        {
            return is_readable($path);
        }

        public static function isWritable($path)
        {
            return is_writable($path);
        }

        public static function isExecutable($path)
        {
            return is_executable($path);
        }

        public static function store($file, $path, $name, $extension)
        {
            $filename = $name . '.' . $extension;
            $destination = $path . $filename;
            if (move_uploaded_file($file, $destination)) {
                return $destination;
            }
            return false;
        }         
            
        public static function asset($path)
        {
            return public_path($path);
        }

        public static function download($path)
        {
            if (file_exists($path)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($path));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($path));
                readfile($path);
                exit;
            }
            return new ApplicationException("File not found: {$path}","Lynx/System/Exception/FileException.php",404);
        }

        public static function copy($path, $destination)
        {
            if (file_exists($path)) {
                return copy($path, $destination);
            }
            return new ApplicationException("File not found: {$path}","Lynx/System/Exception/FileException.php",404);
        }

        public static function move($path, $destination)
        {
            if (file_exists($path)) {
                return rename($path, $destination);
            }
            return new ApplicationException("File not found: {$path}","Lynx/System/Exception/FileException.php",404);
        }

        public static function rename($path, $name)
        {
            if (file_exists($path)) {
                return rename($path, $name);
            }
            return new ApplicationException("File not found: {$path}","Lynx/System/Exception/FileException.php",404);   
        }

        //read
        public static function read($path)
        {
            if (file_exists($path)) {
                $file = fopen($path, "r");
                $content = fread($file, filesize($path));
                fclose($file);
                return $content;
            }
            return new ApplicationException("File not found: {$path}","Lynx/System/Exception/FileException.php",404);
        }

        public static function getAllFiles($path)
        {
            if (file_exists($path)) {
                $files = scandir($path);
                $files = array_diff($files, array('.', '..'));
                return $files;
            }
            return new ApplicationException("File not found: {$path}","Lynx/System/Exception/FileException.php",404);
        }
}