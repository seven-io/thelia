<?php namespace Sms77\Form;

use Sms77\Sms77;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class BulkSms extends BaseForm {
    protected function buildForm() {
        $this->formBuilder->add(
            'filter_reseller',
            'checkbox',
            [
                'label' => Translator::getInstance()->trans(
                    'filter_reseller', [], Sms77::DOMAIN_NAME),
                'label_attr' => [
                    'for' => 'filter_reseller',
                    'help' => Translator::getInstance()
                        ->trans('filter_reseller_help', [], Sms77::DOMAIN_NAME),
                ],
            ]
        );

        $this->formBuilder
            ->add('text', 'textarea', [
                    'label' => Translator::getInstance()
                        ->trans('sms_text', [], Sms77::DOMAIN_NAME),
                    'label_attr' => [
                        'for' => 'text',
                        'help' => Translator::getInstance()
                            ->trans('sms_text_help', [], Sms77::DOMAIN_NAME),
                    ],
                    'required' => true,
                ]
            );

        $this->formBuilder
            ->add('from', 'text', [
                    'data' => Sms77::getSmsFrom(),
                    'label' => Translator::getInstance()
                        ->trans('sms_from', [], Sms77::DOMAIN_NAME),
                    'label_attr' => [
                        'for' => 'from',
                        'help' => Translator::getInstance()
                            ->trans('sms_from_help', [], Sms77::DOMAIN_NAME),
                    ],
                ]
            );
    }

    public function getName() {
        return 'sms77bulksmsform';
    }
}
