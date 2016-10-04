<?php

namespace Sylvanus\Config;

use \Symfony\Component\Yaml\Yaml;
use \Sylvanus\FileSystem\FileSystem;

class Config {

    public static $config = [];
    
    public static function addFromArray($array) {
        if (count($array) > 0) {
            self::$config = array_replace_recursive(self::$config, $array);
        }
    }
    
    public static function addFromYaml($path) {
        if (FileSystem::exists($path)) {
            $array = Yaml::parse(file_get_contents($path));
            self::$config = array_replace_recursive(self::$config, $array);
        }
    }

    public static function get($key) {

        $subArray = [];

        $keyElements = explode(".", $key);
        if (count($keyElements) > 0) {
            foreach ($keyElements AS $key) {
                if (count($subArray) > 0) {
                    if (array_key_exists($key, $subArray)) {
                        $subArray = $subArray[$key];
                    } else {
                        return null;
                    }
                } else {
                    if (array_key_exists($key, self::$config)) {
                        $subArray = self::$config[$key];
                    } else {
                        return null;
                    }
                }
            }
        }

        return $subArray;
    }

}
