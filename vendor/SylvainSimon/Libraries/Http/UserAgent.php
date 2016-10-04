<?php

namespace Sylvanus\Request;

use UAParser\Parser;
use UAParser\Result\Client;
use Sylvanus\Http\Request;

class UserAgent {

    const BROWSER_CHROME = "Chrome";
    const BROWSER_CHROME_MOBILE = "Chrome Mobile";
    const BROWSER_CHROME_LABEL = "Google Chrome";
    const BROWSER_CHROME_MOBILE_LABEL = "Chrome Mobile";
    const BROWSER_FIREFOX = "Firefox";
    const BROWSER_FIREFOX_LABEL = "Mozilla Firefox";
    const BROWSER_INTERNET_EXPLORER = "IE";
    const BROWSER_INTERNET_EXPLORER_LABEL = "Internet Explorer";
    const BROWSER_INTERNET_EXPLORER_MOBILE = "IE Mobile";
    const BROWSER_INTERNET_EXPLORER_MOBILE_LABEL = "Internet Explorer Mobile";
    const BROWSER_EDGE = "Edge";
    const BROWSER_EDGE_LABEL = "Microsoft Edge";
    const BROWSER_SAFARI = "Safari";
    const BROWSER_SAFARI_LABEL = "Safari";
    const BROWSER_SAFARI_MOBILE = "Mobile Safari";
    const BROWSER_SAFARI_MOBILE_LABEL = "Safari Mobile";
    const BROWSER_OPERA = "Opera";
    const BROWSER_OPERA_LABEL = "Opera";

    /** @var Client */
    public static $client = null;

    protected static function createClient() {
        self::$client = Parser::create()->parse(Request::getServer('HTTP_USER_AGENT'));
        return self::$client;
    }

    /**
     * Fill the instance
     * @return Client
     */
    public static function fillParser() {
        if (self::$client === null) {
            self::createClient();
        }
        return self::$client;
    }

    public static function getBrowserName() {
        self::fillParser();
        return (self::$client->ua->family !== null) ? self::$client->ua->family : "";
    }

    public static function getBrowserVersion($minor = false) {

        self::fillParser();

        if ($minor) {
            return (self::$client->ua->minor !== null) ? self::$client->ua->minor : 0;
        } else {
            return (self::$client->ua->major !== null) ? self::$client->ua->major : 0;
        }
    }

    public static function getSystemName() {
        self::fillParser();
        return (self::$client->os->family !== null) ? self::$client->os->family : "";
    }

    public static function getSystemVersion($minor = false) {

        self::fillParser();

        if ($minor) {
            return (self::$client->os->minor !== null) ? self::$client->os->minor : 0;
        } else {
            return (self::$client->os->major !== null) ? self::$client->os->major : 0;
        }
    }
}
