<?php

namespace Helium\EmailNotifications\Tests;

use Helium\EmailNotifications\EmailNotificationManager;
use Helium\EmailNotifications\Tests\Fakes\FakeMailerEngine;use Helium\FacadeManager\FacadeManager;
use Helium\FacadeManager\Tests\FacadeManagerTest;

class EmailNotificationManagerTest extends FacadeManagerTest
{
	protected function getInstance(): FacadeManager
	{
		$manager = new EmailNotificationManager('fake');

		$manager->extend('fake', function() {
			return $this->getNewEngine();
		});

		return $manager;
	}

	protected function getNewEngine()
	{
		return new FakeMailerEngine();
	}

	protected function getNewEngine2()
	{
		return new FakeMailerEngine();
	}

	public function testPassthroughReturnsExpected()
	{
		$manager = $this->getInstance();

		$this->assertEquals(
			$manager,
			$manager->setServerSettings([])
		);

		$this->assertEquals(
			$manager,
			$manager->setFromAddress('')
		);

		$this->assertEquals(
			$manager,
			$manager->setRecipients('')
		);

		$this->assertEquals(
			$manager,
			$manager->setBCC('')
		);

		$this->assertEquals(
			$manager,
			$manager->setCC('')
		);

		$this->assertEquals(
			$manager,
			$manager->setAttachment('')
		);

		$this->assertEquals(
			$manager,
			$manager->setSubject('')
		);

		$this->assertEquals(
			$manager,
			$manager->setBody('')
		);

		$this->assertEquals(
			$manager,
			$manager->setAltBody('')
		);

		$this->assertEquals(
			$manager,
			$manager->setCustomHeader('', '')
		);

		$this->assertNull($manager->sendEmail());
	}
}