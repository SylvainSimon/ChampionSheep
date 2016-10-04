<?php

namespace Sylvanus\Encryption;

use Sylvanus\Encryption\Encrypt;
use Sylvanus\Encryption\Decrypt;

class Encryption {

    public static $resTd;
    public static $salt = "";

    const SIMPLE = 1;
    const MCRYPT = 2;

    /**
     * Encode une chaine de caractère
     * @param string $value Valeur à encrypter
     * @param bool $urlEncode
     * @param string $salt Grain de sel
     * @param int $type Méthode de chiffrement
     * @return string
     */
    public static function encrypt($value = "", $urlEncode = false, $salt = null, $type = self::MCRYPT) {
        switch ($type) {
            case self::SIMPLE:
                $debasedValue = Encrypt::simpleEncrypt($value);
                return base64_encode(self::generateSimpleKey($debasedValue, $salt));
            case self::MCRYPT:
                $encryptDescription = self::initializeMcrypt();
                return Encrypt::encryptMcrypt($value, $urlEncode, $salt, $encryptDescription);
        }
    }

    /**
     * Décode une chaine de caractère
     * @param type $value Valeur à décrypter
     * @param type $salt Grain de sel
     * @param int $type Méthode de chiffrement
     * @return string
     */
    public static function decrypt($value = "", $salt = null, $type = self::MCRYPT) {
        switch ($type) {
            case self::SIMPLE:
                $debasedValue = Encryption::generateSimpleKey(base64_decode($value), $salt);
                return Decrypt::simpleDecrypt($debasedValue);
            case self::MCRYPT:
                $encryptDescription = self::initializeMcrypt();
                return Decrypt::decryptMcrypt($value, $salt, $encryptDescription);
        }
    }
    
    /**
     * Créer une clès pour l'encodage simple
     * @param type $value
     * @param type $salt
     * @return type
     */
    public static function generateSimpleKey($value, $salt = null) {

        $str_key = md5($salt);
        $cnt = 0;
        $tmp = '';
        for ($i = 0; $i < strlen($value); $i++) {
            if ($cnt == strlen($str_key))
                $cnt = 0;
            $tmp.= substr($value, $i, 1) ^ substr($str_key, $cnt, 1);
            $cnt++;
        }
        return $tmp;
    }

    public static function initializeMcrypt($algorithm = MCRYPT_RIJNDAEL_256, $mode = MCRYPT_MODE_CFB) {

        if (!extension_loaded("mcrypt")) {
            throw new \Exception('The PHP mcrypt extension is not installed');
        }

        $encryptDescription = mcrypt_module_open($algorithm, "", $mode, "");
        if ($encryptDescription == false) {
            throw new \Exception('Error initializing encryption module');
        }

        return $encryptDescription;
    }

    public static function hash($strPassword, $cost) {

        if (function_exists('password_hash')) {
            return password_hash($strPassword, PASSWORD_BCRYPT, array('cost' => $cost));
        } elseif (CRYPT_BLOWFISH == 1) {
            return crypt($strPassword, '$2y$' . sprintf('%02d', $cost) . '$' . md5(uniqid(mt_rand(), true)) . '$');
        } elseif (CRYPT_SHA512 == 1) {
            return crypt($strPassword, '$6$' . md5(uniqid(mt_rand(), true)) . '$');
        } elseif (CRYPT_SHA256 == 1) {
            return crypt($strPassword, '$5$' . md5(uniqid(mt_rand(), true)) . '$');
        } else {
            throw new \Exception('None of the required crypt() algorithms is available');
        }
    }

    public static function test($strHash) {
        if (strncmp($strHash, '$2y$', 4) === 0) {
            return true;
        } elseif (strncmp($strHash, '$2a$', 4) === 0) {
            return true;
        } elseif (strncmp($strHash, '$6$', 3) === 0) {
            return true;
        } elseif (strncmp($strHash, '$5$', 3) === 0) {
            return true;
        }
        return false;
    }

    public static function verify($strPassword, $strHash) {

        if (function_exists('password_verify')) {
            return password_verify($strPassword, $strHash);
        }
        $getLength = function($str) {
            return extension_loaded('mbstring') ? mb_strlen($str, '8bit') : strlen($str);
        };
        $newHash = crypt($strPassword, $strHash);
        if (!is_string($newHash) || $getLength($newHash) != $getLength($strHash) || $getLength($newHash) <= 13) {
            return false;
        }
        $intStatus = 0;
        for ($i = 0; $i < $getLength($newHash); $i++) {
            $intStatus |= (ord($newHash[$i]) ^ ord($strHash[$i]));
        }
        return $intStatus === 0;
    }

}
