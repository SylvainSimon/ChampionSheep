<?php

namespace Sylvanus\Validator;

use \JsonSchema\RefResolver;
use \JsonSchema\Validator;
use \JsonSchema\Uri\UriRetriever;
use \JsonSchema\Uri\UriResolver;

class Schema {

    public static function validate($data, $schemaUrl, $type) {

        switch ($type) {
            case "json":
                return self::validateJson($data, $schemaUrl);
            case "xml":
                return self::validateXml($data, $schemaUrl);
            default:
                return false;
        }
    }

    public static function validateJson($data, $schemaUrl) {
        
        $refResolver = new RefResolver(new UriRetriever(), new UriResolver());
        $schema = $refResolver->resolve($schemaUrl);

        $validator = new Validator();
        $validator->check(json_decode($data), $schema);

        if ($validator->isValid()) {
            return true;
        } else {
            $stringError = "";
            foreach ($validator->getErrors() as $error) {
                $stringError .= sprintf("[%s] %s\n", $error['property'], $error['message']);
            }
            return $stringError;
        }

        return false;
    }

    public static function validateXml($data, $schemaUrl) {

        $xml = new \DOMDocument();
        $xml->loadXML($data);
        
        if (!$xml->schemaValidateSource(file_get_contents($schemaUrl))) {
            return "Y'a une erreur";
        } else {
            return true;
        }
    }

}
