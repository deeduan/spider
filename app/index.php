<?php

class HandleFile
{
    public static function files($dir)
    {
        $files = [];
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") {
                        $files[] = $dir.DIRECTORY_SEPARATOR.$file;
                    }
                }
                closedir($dh);
            }
        }

        return $files;
    }
}





