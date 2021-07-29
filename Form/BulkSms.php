<?php namespace Sms77\Form;

use Sms77\Sms77;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class BulkSms extends BaseForm {
    protected function buildForm() {
        $this->formBuilder->add('filter_reseller', 'checkbox', [
            'label' => Translator::getInstance()->trans(
                'filter_reseller', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'filter_reseller',
                'help' => Translator::getInstance()
                    ->trans('filter_reseller_help', [], Sms77::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('debug', 'checkbox', [
            'label' => Translator::getInstance()->trans(
                'debug', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'debug',
                'help' => Translator::getInstance()
                    ->trans('debug_help', [], Sms77::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('no_reload', 'checkbox', [
            'label' => Translator::getInstance()->trans(
                'sms_no_reload', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'no_reload',
                'help' => Translator::getInstance()
                    ->trans('sms_no_reload_help', [], Sms77::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('flash', 'checkbox', [
            'label' => Translator::getInstance()->trans(
                'sms_flash', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'flash',
                'help' => Translator::getInstance()
                    ->trans('sms_flash_help', [], Sms77::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('performance_tracking', 'checkbox', [
            'label' => Translator::getInstance()->trans(
                'sms_performance_tracking', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'performance_tracking',
                'help' => Translator::getInstance()
                    ->trans('sms_performance_tracking_help', [], Sms77::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('text', 'textarea', [
            'label' => Translator::getInstance()
                ->trans('sms_text', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'text',
                'help' => Translator::getInstance()
                    ->trans('sms_text_help', [], Sms77::DOMAIN_NAME),
            ],
            'required' => true,
        ]);

        $this->formBuilder->add('from', 'text', [
            'data' => Sms77::getSmsFrom(),
            'label' => Translator::getInstance()
                ->trans('sms_from', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'from',
                'help' => Translator::getInstance()
                    ->trans('sms_from_help', [], Sms77::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('label', 'text', [
            'label' => Translator::getInstance()
                ->trans('sms_label', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'label',
                'help' => Translator::getInstance()
                    ->trans('sms_label_help', [], Sms77::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('foreign_id', 'text', [
            'label' => Translator::getInstance()
                ->trans('sms_foreign_id', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'foreign_id',
                'help' => Translator::getInstance()
                    ->trans('sms_foreign_id_help', [], Sms77::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('delay', DateTimeType::class, [
            'label' => $this->translator->trans('sms_delay', [], Sms77::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'delay',
                'help' => Translator::getInstance()
                    ->trans('sms_delay_help', [], Sms77::DOMAIN_NAME),
            ],
            'widget' => 'single_text',
        ]);
    }

    public function getName() {
        return 'sms77bulksmsform';
    }
}
