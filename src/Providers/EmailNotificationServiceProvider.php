<?php

namespace Helium\EmailNotifications\Providers;

use Helium\EmailNotifications\Facades\EmailNotification;
use Helium\EmailNotifications\EmailNotificationManager;
use Helium\EmailNotifications\Engines\PhpMailerEngine;
use Helium\EmailNotifications\Engines\SwiftMailerEngine;
use Illuminate\Support\ServiceProvider;

class EmailNotificationServiceProvider extends ServiceProvider
{
	/**
	 * Register any application Services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../config/email-notification.php',
			'email-notification'
		);

		if (!is_null(config('email-notification'))) {
			$this->app->bind(EmailNotification::FACADE_ACCESSOR, function() {
				$manager = new EmailNotificationManager(config('email-notification.default'));

				$manager->extend('phpMailer', function() {
					return new PhpMailerEngine();
				});

				$manager->extend('swiftMailer', function() {
					return new SwiftMailerEngine();
				});

				return $manager;
			});
		}
	}

	/**
	 * Bootstrap any application Services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../config/email-notification.php'
				=> config_path('email-notification.php'),
		]);
	}
}