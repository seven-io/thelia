<?php namespace Seven;

use Thelia\Module\BaseModule;

class Seven extends BaseModule {
    const DOMAIN_NAME = 'seven';

    public static function getApiKey(): string {
        return self::getConfigValue(Setting::API_KEY, '');
    }

    public static function setApiKey(array $data) {
        self::setConfigValue(Setting::API_KEY, $data[Setting::API_KEY]);
    }

    public static function getSmsFrom(): string {
        return self::getConfigValue(Setting::SMS_FROM, '');
    }

    public static function setSmsFrom(array $data) {
        self::setConfigValue(Setting::SMS_FROM, $data[Setting::SMS_FROM]);
    }
}
