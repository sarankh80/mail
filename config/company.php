<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Company identity
    |--------------------------------------------------------------------------
    */

    'name' => env('COMPANY_NAME', 'Example Company'),

    'domain' => env('MAIL_DOMAIN', 'example.test'),

    'webmail_url' => env('WEBMAIL_URL', 'https://mail.example.test'),

    'admin_email' => env('COMPANY_ADMIN_EMAIL', 'admin@example.test'),

    'support_email' => env('COMPANY_SUPPORT_EMAIL', 'support@example.test'),

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    */

    'brand' => [
        'primary_color' => env('BRAND_PRIMARY_COLOR', '#2563eb'),
        'accent_color' => env('BRAND_ACCENT_COLOR', '#0ea5e9'),
        'logo_path' => env('BRAND_LOGO_PATH', 'images/logo.svg'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    */

    'locales' => [
        'primary' => env('PRIMARY_LOCALE', 'en'),
        'secondary' => env('SECONDARY_LOCALE', 'km'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Mailbox defaults
    |--------------------------------------------------------------------------
    */

    'default_quota_mb' => (int) env('DEFAULT_MAILBOX_QUOTA_MB', 1024),

    'linux_mail_group' => env('MAIL_LINUX_GROUP', 'mailusers'),

    'shared_mailbox_group_prefix' => env('MAIL_SHARED_GROUP_PREFIX', 'mailshare-'),

    /*
    |--------------------------------------------------------------------------
    | Mail server connectivity (IMAP / SMTP / Dovecot admin)
    |--------------------------------------------------------------------------
    */

    'imap' => [
        'host' => env('IMAP_HOST', '127.0.0.1'),
        'port' => (int) env('IMAP_PORT', 993),
        'encryption' => env('IMAP_ENCRYPTION', 'ssl'),
        'validate_cert' => (bool) env('IMAP_VALIDATE_CERT', true),
    ],

    'smtp' => [
        'host' => env('SMTP_SUBMISSION_HOST', '127.0.0.1'),
        'port' => (int) env('SMTP_SUBMISSION_PORT', 587),
        'encryption' => env('SMTP_SUBMISSION_ENCRYPTION', 'tls'),
    ],

    'relay' => [
        'driver' => env('MAIL_RELAY_DRIVER', 'direct'), // direct | ses | mailgun | resend
    ],

    /*
    |--------------------------------------------------------------------------
    | Spam filtering / quarantine
    |--------------------------------------------------------------------------
    */

    'spam' => [
        'default_level' => env('SPAM_FILTER_LEVEL', 'normal'), // relaxed | normal | strict
        'quarantine_retention_days' => (int) env('QUARANTINE_RETENTION_DAYS', 30),
    ],

    /*
    |--------------------------------------------------------------------------
    | Attachments
    |--------------------------------------------------------------------------
    */

    'attachments' => [
        'max_size_mb' => (int) env('ATTACHMENT_MAX_SIZE_MB', 25),
        'blocked_extensions' => [
            'exe', 'dll', 'js', 'vbs', 'bat', 'cmd', 'ps1', 'scr', 'iso', 'docm', 'xlsm', 'pptm',
        ],
        'safe_preview_extensions' => ['pdf', 'png', 'jpg', 'jpeg', 'gif'],
        'clamav_enabled' => (bool) env('CLAMAV_ENABLED', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Push notifications (Web Push / VAPID)
    |--------------------------------------------------------------------------
    */

    'webpush' => [
        'public_key' => env('VAPID_PUBLIC_KEY'),
        'private_key' => env('VAPID_PRIVATE_KEY'),
        'subject' => env('VAPID_SUBJECT', 'mailto:admin@example.test'),
    ],
];
