<?php namespace Sms77\Form;

use Sms77\Sms77;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class Configuration extends BaseForm {
    protected function buildForm() {
        $this->formBuilder->add(
            Sms77::SETTING_API_KEY,
            'text',
            [
                'data' => Sms77::getConfigValue(Sms77::SETTING_API_KEY, ''),
                'label' => Translator::getInstance()
                    ->trans(Sms77::SETTING_API_KEY, [], Sms77::DOMAIN_NAME),
                'label_attr' => [
                    'for' => Sms77::SETTING_API_KEY,
                ],
                'required' => true,
            ]
        );
    }

    public function getName() {
        return 'sms77configform';
    }
}
