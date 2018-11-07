<?php

return [

    'backup' => [

        'name' => config('app.name'),
        'source' => [

            'files' => [

                'include' => [
//                    base_path(),
                ],
                'exclude' => [
                    base_path('vendor'),
                    base_path('node_modules'),
                ],
                'followLinks' => false,
            ],
            'databases' => [
                'mysql',
            ],
        ],

        'database_dump_compressor' => null,
        'destination' => [
            'filename_prefix' => '',
            'disks' => [
                'local','qiniu',
            ],
        ],
        'temporary_directory' => storage_path('app/backup-temp'),
    ],

    'notifications' => [

        'notifications' => [
            \Spatie\Backup\Notifications\Notifications\BackupHasFailed::class => ['mail'],
            \Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFound::class => ['mail'],
            \Spatie\Backup\Notifications\Notifications\CleanupHasFailed::class => ['mail'],
            \Spatie\Backup\Notifications\Notifications\BackupWasSuccessful::class => [],
            \Spatie\Backup\Notifications\Notifications\HealthyBackupWasFound::class => [],
            \Spatie\Backup\Notifications\Notifications\CleanupWasSuccessful::class => [],
        ],

        'notifiable' => \Spatie\Backup\Notifications\Notifiable::class,
        'mail' => [
            'to' => '519494584@qq.com',
        ],
        'slack' => [
            'webhook_url' => '',
            'channel' => null,
            'username' => null,
            'icon' => null,
        ],
    ],

    /*
     * Here you can specify which backups should be monitored.
     * If a backup does not meet the specified requirements the
     * UnHealthyBackupWasFound event will be fired.
     */
    'monitorBackups' => [
        [
            'name' => config('app.name'),
            'disks' => ['local','qiniu'],
            'newestBackupsShouldNotBeOlderThanDays' => 1,
            'storageUsedMayNotBeHigherThanMegabytes' => 5000,
        ],
    ],

    'cleanup' => [
        'strategy' => \Spatie\Backup\Tasks\Cleanup\Strategies\DefaultStrategy::class,
        'defaultStrategy' => [
            'keepAllBackupsForDays' => 7,
            'keepDailyBackupsForDays' => 16,
            'keepWeeklyBackupsForWeeks' => 8,
            'keepMonthlyBackupsForMonths' => 4,
            'keepYearlyBackupsForYears' => 2,
            'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000,
        ],
    ],
];
