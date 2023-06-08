<?php
namespace Seven\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class HookSevenManager extends BaseHook {
    public function onModuleConfiguration(HookRenderEvent $event) {
        $event->add($this->render('seven-config.html'));
    }

    public function onCustomers(HookRenderEvent $event) {
        $event->add($this->render('seven-customers-actions.html'));
    }
}
