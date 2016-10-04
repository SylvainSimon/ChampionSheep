<?php

namespace Sylvanus\Encryption;

class Decrypt {

    public static function decryptMcrypt($value, $salt, $encryptDescription) {
        
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = self::decryptMcrypt($v);
            }
            return $value;
        } elseif ($value == '') {
            return '';
        }

        $value = base64_decode((strpos($value, "%") !== false) ? urldecode($value) : $value);
        $ivsize = mcrypt_enc_get_iv_size($encryptDescription);
        $iv = substr($value, 0, $ivsize);
        $value = substr($value, $ivsize);

        if ($value == '') {
            return '';
        }

        mcrypt_generic_init($encryptDescription, md5($salt), $iv);
        $strDecrypted = mdecrypt_generic($encryptDescription, $value);
        mcrypt_generic_deinit($encryptDescription);

        return $strDecrypted;
    }
    
    public static function simpleDecrypt($value = "") {

        $returnString = '';

        for ($i = 0; $i < strlen($value); $i++) {
            $md5 = substr($value, $i, 1);
            $i++;
            $returnString.= (substr($value, $i, 1) ^ $md5);
        }

        return $returnString;
    }

}
