<?php
namespace Sms77\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class HookSms77Manager extends BaseHook {
    public function onModuleConfiguration(HookRenderEvent $event) {
        $event->add($this->render('sms77-config.html'));
    }

    public function onCustomers(HookRenderEvent $event) {
        $event->add($this->render('sms77-customers-actions.html'));
    }
}
