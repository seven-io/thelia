<?php
return [
    'api_key' => 'API Key',
    'api_key_missing' => 'You have not set an API key yet. 
    Please go to the module settings to set one prior to sending.',

    'bulk_sms' => 'Bulk SMS',
    'bulk_sms_desc' => 'Send SMS to all of your customers.',

    'config' => 'config',

    'filter_reseller' => 'Is reseller?',
    'filter_reseller_help' => 'Narrows down customer search to include only resellers.',
    'filters' => 'Filters',

    'general' => 'General',

    'no_requests' => 'Nothing to send. Try again with a broader combination of filters.',

    'send' => 'Send',
    'sms_delay' => 'Delay',
    'sms_delay_help' => 'Specify a custom point of time for time-delayed SMS.',
    'sms_delay_placeholder' => 'YYYY-MM-DD',
    'sms_flash' => 'Flash',
    'sms_flash_help' => 'If enabled, SMS get displayed directly in the receivers display.',
    'sms_foreign_id' => 'Foreign ID',
    'sms_foreign_id_help' => 'Gets returned in callbacks. 
    Max. 64 chars, allowed characters: a-z, A-Z, 0-9, .-_@.',
    'sms_from' => 'Sender',
    'sms_from_help' => 'Up to 11 alphanumeric or 16 numeric characters.',
    'sms_label' => 'Label',
    'sms_label_help' => 'For custom usage.
     Max. 100 chars, allowed characters: a-z, A-Z, 0-9, .-_@.',
    'sms_no_reload' => 'No reload lock',
    'sms_no_reload_help' => 'Deactivates the reload lock to allow sending duplicate SMS.',
    'sms_performance_tracking' => 'Performance Tracking',
    'sms_performance_tracking_help' =>
        'Enable performance tracking for URLs found in the message text.',
    'sms_text' => 'Text',
    'sms_text_help' => 'The message content. Up to 1520 characters.',
    'sms_text_placeholder' => 'Hi {{firstname}} {{lastname}} is your email {{email}}?',
    'submit' => 'Submit',
];
