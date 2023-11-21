<?php
return [
    'api_key' => 'API-Schlüssel',
    'api_key_missing' => 'Es wurde noch kein API-Schlüssel gesetzt. 
    Bitte diesen in den Moduleinstellungen setzen vor Nachrichtenversand.',

    'bulk_sms' => 'Massen-SMS',
    'bulk_sms_desc' => 'SMS-Versand an die gesamte Kundschaft.',

    'config' => 'Konfiguration',

    'filter_reseller' => 'Ist Wiederverkäufer?',
    'filter_reseller_help' => 'Limitiert die Kundensuche auf nur Wiederkäufer.',
    'filters' => 'Filter',

    'general' => 'Generell',

    'no_requests' => 'Keine Rufnummer(n) für Versand. 
    Bitte nochmal versuchen mit anderer Filter-Konfiguration.',

    'send' => 'Senden',
    'sms_delay' => 'Versandzeitpunkt',
    'sms_delay_help' => 'Einen Versandzeitpunkt setzen für zeitversetzen SMS-Versand.',
    'sms_delay_placeholder' => 'YYYY-MM-DD',
    'sms_flash' => 'Flash',
    'sms_flash_help' => 'Flash-SMS werden, geräteabhängig, direkt im Display angezeigt und nicht gespeichert.',
    'sms_foreign_id' => 'Foreign ID',
    'sms_foreign_id_help' => 'Wird in DLR-Callbacks etc. zurückgegeben. 
    Max. 64 Zeichen bestehend aus a-z, A-Z, 0-9, .-_@.',
    'sms_from' => 'Absender',
    'sms_from_help' => 'Bis zu 11 alphanumerischen oder 16 numerischen Zeichen.',
    'sms_label' => 'Label',
    'sms_label_help' => 'Für Zuordnung bei der Statistik.
     Max. 100 Zeichen bestehend aus a-z, A-Z, 0-9, .-_@.',
    'sms_no_reload' => 'Erlaube Duplikate',
    'sms_no_reload_help' => 'Erlaubt den Versand von Duplikaten wo Text und Empfänger innerhalb 180 Sekunden identisch sind.',
    'sms_performance_tracking' => 'Performance Tracking',
    'sms_performance_tracking_help' =>
        'Aktiviert Performance Tracking für im Nachrichtentext gefundene Links.',
    'sms_text' => 'Text',
    'sms_text_help' => 'Der Nachrichteninhalt. Bis zu 1520 Zeichen.',
    'sms_text_placeholder' => 'Hallo {{firstname}} {{lastname}} lautet Ihre E-Mail {{email}}?',
    'submit' => 'Absenden',
];
