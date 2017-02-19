<?php

namespace Torlax;

use ZipArchive;

class Utilities
{
    public static function unzipFile(
        $path,
        $extractTo,
        $rootDir = false
    )
    {
        $zip = new ZipArchive;
        $file = $zip->open($path);
        if ($file === false) {
            exit('It nuh work');
        }

        $zip->extractTo($extractTo);
        $zip->close();

        if ($rootDir) {
            $sourceFolder = "$extractTo/$rootDir";
            $files = scandir($sourceFolder);

            $files = array_filter(
                $files,
                function ($value) {
                    if ($value === '..' || $value === '.') return false;

                    return true;
                }
            );

            foreach ($files as $file) {
                $rename = rename("$sourceFolder/$file", "$extractTo/$file");
            }

            rmdir($sourceFolder);
        }

        exit("$path unzipped to $extractTo");
    }
}
