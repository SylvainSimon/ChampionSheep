<?php

namespace Sylvanus\Mail;

use Sylvanus\FileSystem\FileSystem;
use Sylvanus\Http\Request\Request;

class MailMessage {

    /** @var \Swift_Message */
    public static $objMessage = null;

    /**
     * @return \Swift_Message
     */
    public static function create() {
        self::$objMessage = new \Swift_Message();
        return self::$objMessage;
    }

    public static function attachFromPaths($arrPaths = []) {
        if (count($arrPaths) > 0) {
            foreach ($arrPaths AS $path) {
                $attachment = \Swift_Attachment::fromPath($path, "application/octet-stream");
                $attachment->setFilename(basename($path));
                self::$objMessage->attach($attachment);
            }
        }
    }

    public static function attachFromData($file) {
        $attachment = \Swift_Attachment::newInstance();
        $attachment->setFilename($file["filename"]);
        $attachment->setContentType("application/octet-stream");
        $attachment->setBody($file["data"]);
        self::$objMessage->attach($attachment);
    }

    public static function embedImages($strbody = "") {

        $arrMatches = [];
        preg_match_all('/(src=|url\()"([^"]+\.(jpe?g|png|gif|bmp|tiff?|swf))"/Ui', $strbody, $arrMatches);

        foreach (array_unique($arrMatches[2]) as $url) {
            $src = rawurldecode(str_replace(Request::base(), '', $url));
            if (!preg_match('@^https?://@', $src) && FileSystem::exists(TL_ROOT . '/' . $src)) {
                $cid = self::$objMessage->embed(\Swift_EmbeddedFile::fromPath(TL_ROOT . '/' . $src));
                $strbody = str_replace(['src="' . $url . '"', 'url("' . $url . '"'], ['src="' . $cid . '"', 'url("' . $cid . '"'], $strbody);
            }
        }

        return $strbody;
    }

    public static function setRecipients($arrRecipients) {
        if (count($arrRecipients) > 0) {
            self::$objMessage->setTo($arrRecipients);
        }
    }

    public static function getRecipients($withName = false) {
        return ($withName) ? self::$objMessage->getTo() : array_keys(self::$objMessage->getTo());
    }

    public static function getInstanceOfMessage() {
        return self::$objMessage;
    }

}
