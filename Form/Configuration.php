<?php namespace Sms77\Form;

use Sms77\Sms77;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class Configuration extends BaseForm {
    protected function buildForm() {
        $this->formBuilder->add(
            'api_key',
            'text',
            [
                'data' => Sms77::getApiKey(),
                'label' => Translator::getInstance()
                    ->trans('api_key', [], Sms77::DOMAIN_NAME),
                'label_attr' => [
                    'for' => 'api_key',
                ],
                'required' => true,
            ]
        );

        $this->formBuilder->add(
            'sms_from',
            'text',
            [
                'data' => Sms77::getSmsFrom(),
                'label' => Translator::getInstance()
                    ->trans('sms_from', [], Sms77::DOMAIN_NAME),
                'label_attr' => [
                    'for' => 'sms_from',
                    'help' => Translator::getInstance()
                        ->trans('sms_from_help', [], Sms77::DOMAIN_NAME),
                ],
            ]
        );
    }

    public function getName() {
        return 'sms77configform';
    }
}
