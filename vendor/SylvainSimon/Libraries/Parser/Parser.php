<?php

namespace Sylvanus\Parser;

class Parser {

    public static function parse($data, $format) {

        switch ($format) {
            case "json":
                return self::parseJson($data);
            case "xml":
                return self::parseXml($data);
            default:
                return false;
        }
    }

    public static function parseJson($data) {
        return json_decode($data, true);
    }

    public static function parseXml($data) {
        $xml = simplexml_load_string($data);
        $json = json_encode($xml);
        return json_decode($json, true);
    }

}
