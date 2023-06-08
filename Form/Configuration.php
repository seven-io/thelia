<?php namespace Seven\Form;

use Seven\Seven;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class Configuration extends BaseForm {
    protected function buildForm() {
        $this->formBuilder->add(
            'api_key',
            'text',
            [
                'data' => Seven::getApiKey(),
                'label' => Translator::getInstance()
                    ->trans('api_key', [], Seven::DOMAIN_NAME),
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
                'data' => Seven::getSmsFrom(),
                'label' => Translator::getInstance()
                    ->trans('sms_from', [], Seven::DOMAIN_NAME),
                'label_attr' => [
                    'for' => 'sms_from',
                    'help' => Translator::getInstance()
                        ->trans('sms_from_help', [], Seven::DOMAIN_NAME),
                ],
            ]
        );
    }

    public function getName() {
        return 'sevenconfigform';
    }
}
