<?php

namespace Sylvanus\Encryption;

class Encrypt {

    public static function encryptMcrypt($value, $urlEncode, $salt, $encryptDescription) {

        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = urlencode(self::encrypt($v));
            }
            return $value;
        } elseif ($value == '') {
            return '';
        }

        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($encryptDescription), MCRYPT_RAND);
        mcrypt_generic_init($encryptDescription, md5($salt), $iv);
        $strEncrypted = mcrypt_generic($encryptDescription, $value);
        $strEncrypted = base64_encode($iv . $strEncrypted);
        mcrypt_generic_deinit($encryptDescription);

        if ($urlEncode) {
            return urlencode($strEncrypted);
        }

        return $strEncrypted;
    }

    public static function simpleEncrypt($value = "") {

        $return = '';
        srand((double) microtime() * 1000000);

        $str_cryptkey = md5(rand(0, 32000));
        $count = 0;

        for ($i = 0; $i < strlen($value); $i++) {
            $count = ($count == strlen($str_cryptkey)) ? 0 : $count;
            $return.= substr($str_cryptkey, $count, 1) . (substr($value, $i, 1) ^ substr($str_cryptkey, $count, 1));
            $count++;
        }

        return $return;
    }

}
