<?php namespace Sms77;

use Thelia\Module\BaseModule;

class Sms77 extends BaseModule {
    const DOMAIN_NAME = 'sms77';

    const SETTING_API_KEY = 'api_key';

    public static function getApiKey(): string {
        return self::getConfigValue(self::SETTING_API_KEY, '');
    }
}
