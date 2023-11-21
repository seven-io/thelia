<?php namespace Seven\Form;

use Seven\Seven;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class BulkSms extends BaseForm {
    protected function buildForm() {
        $this->formBuilder->add('filter_reseller', 'checkbox', [
            'label' => Translator::getInstance()->trans(
                'filter_reseller', [], Seven::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'filter_reseller',
                'help' => Translator::getInstance()
                    ->trans('filter_reseller_help', [], Seven::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('no_reload', 'checkbox', [
            'label' => Translator::getInstance()->trans(
                'sms_no_reload', [], Seven::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'no_reload',
                'help' => Translator::getInstance()
                    ->trans('sms_no_reload_help', [], Seven::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('flash', 'checkbox', [
            'label' => Translator::getInstance()->trans(
                'sms_flash', [], Seven::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'flash',
                'help' => Translator::getInstance()
                    ->trans('sms_flash_help', [], Seven::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('performance_tracking', 'checkbox', [
            'label' => Translator::getInstance()->trans(
                'sms_performance_tracking', [], Seven::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'performance_tracking',
                'help' => Translator::getInstance()
                    ->trans('sms_performance_tracking_help', [], Seven::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('text', 'textarea', [
            'label' => Translator::getInstance()
                ->trans('sms_text', [], Seven::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'text',
                'help' => Translator::getInstance()
                    ->trans('sms_text_help', [], Seven::DOMAIN_NAME),
            ],
            'required' => true,
        ]);

        $this->formBuilder->add('from', 'text', [
            'data' => Seven::getSmsFrom(),
            'label' => Translator::getInstance()
                ->trans('sms_from', [], Seven::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'from',
                'help' => Translator::getInstance()
                    ->trans('sms_from_help', [], Seven::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('label', 'text', [
            'label' => Translator::getInstance()
                ->trans('sms_label', [], Seven::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'label',
                'help' => Translator::getInstance()
                    ->trans('sms_label_help', [], Seven::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('foreign_id', 'text', [
            'label' => Translator::getInstance()
                ->trans('sms_foreign_id', [], Seven::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'foreign_id',
                'help' => Translator::getInstance()
                    ->trans('sms_foreign_id_help', [], Seven::DOMAIN_NAME),
            ],
        ]);

        $this->formBuilder->add('delay', DateTimeType::class, [
            'label' => $this->translator->trans('sms_delay', [], Seven::DOMAIN_NAME),
            'label_attr' => [
                'for' => 'delay',
                'help' => Translator::getInstance()
                    ->trans('sms_delay_help', [], Seven::DOMAIN_NAME),
            ],
            'widget' => 'single_text',
        ]);
    }

    public function getName() {
        return 'sevenbulksmsform';
    }
}
