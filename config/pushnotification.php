<?php
/**
 * @see https://github.com/Edujugon/PushNotification
 */

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => '
        AAAAYt8w42w:APA91bFwa4b3i0Fk1r69dvuj0Vs_D_F3VR0qBY7vpM6qq5WEJlrCcXisLq4EA97NQOGEdLhqRW9g5QjzyDMzgbNko5diK4HTrauXAq75xdlsFo9W4p6kCED7LAdFE0WQ27d3FTDTGC7Y
        ',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        'passPhrase' => 'secret', //Optional
        'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true,
    ],
];
