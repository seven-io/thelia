<?php namespace Sms77;

use Thelia\Module\BaseModule;

class Sms77 extends BaseModule {
    const DOMAIN_NAME = 'sms77';

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
