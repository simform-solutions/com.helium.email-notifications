<?php

return [
    /**
     * Default settings for all mail engines
     */
	'defaults' => [
	    'engine' => env('MAIL_ENGINE', 'php_mailer'),
        'view_template_dir' => 'email', //Relative to resources/views
        'from_address' => env('MAIL_FROM_ADDRESS'),
        'from_name' => env('MAIL_FROM_NAME'),
        'host' => env('MAIL_HOST'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'port' => env('MAIL_PORT')
    ],

    /**
     * Engine-specific configuration settings
     */
    'engines' => [
        'php_mailer' => [
            'class' => \Helium\EmailNotifications\Engines\PhpMailerEngine::class,
            'exceptions' => false,
            'mailer' => env('MAIL_MAILER'),
            'smtp_auth' => env('MAIL_SMTP_AUTH', false)
        ],
        'swift_mailer' => [
            'class' => \Helium\EmailNotifications\Engines\SwiftMailerEngine::class
        ]
    ],

    /**
     * Email message settings
     * html_template and plaintext_template are relative to defaults.view_template_dir (resources/views/email by default)
     */
    'messages' => [
         'welcome' => [
            'subject' => 'Welcome to MyApp!',
             'html_view' => 'welcome/welcome_html',
             'plaintext_view' => 'welcome/welcome_plaintext'
         ]
    ]
];