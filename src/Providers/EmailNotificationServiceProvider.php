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
			$this->app->register(EmailNotification::FACADE_ACCESSOR, function() {
				return new EmailNotificationManager(config('email-notification.default'));

				EmailNotification::extend('phpMailer', function() {
					return new PhpMailerEngine();
				});

				EmailNotification::extend('swiftMailer', function() {
					return new SwiftMailerEngine();
				});
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