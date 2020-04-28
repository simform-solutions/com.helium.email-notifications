<?php

namespace Helium\EmailNotifications\Tests;

use Helium\EmailNotifications\EmailNotificationManager;
use Helium\EmailNotifications\Tests\Fakes\FakeMailerEngine;
use Helium\FacadeManager\EngineContract;
use Helium\FacadeManager\FacadeManager;
use Helium\FacadeManager\Tests\Base\FacadeManagerPackageTest;

class EmailNotificationManagerTest extends FacadeManagerPackageTest
{
	protected function getInstance(): FacadeManager
	{
		$manager = new EmailNotificationManager('fake');

		$manager->extend('fake', function() {
			return $this->getNewEngine();
		});

		return $manager;
	}

	protected function getNewEngine(): EngineContract
	{
		return new FakeMailerEngine();
	}

	protected function getNewEngine2(): EngineContract
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
			$manager->addRecipient('')
		);

		$this->assertEquals(
			$manager,
			$manager->addBcc('')
		);

		$this->assertEquals(
			$manager,
			$manager->addCc('')
		);

		$this->assertEquals(
			$manager,
			$manager->addAttachment('')
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