<?php

namespace Helium\EmailNotifications\Engines;

use Helium\EmailNotifications\Contracts\EmailEngineContract;
use Swift_Attachment;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;

class SwiftMailerEngine extends EmailEngineContract
{
    private $mailer = null;
	private $message = null;

	public function __construct()
	{
	    $transport = new Swift_SmtpTransport(
	        config('email.defaults.host'),
            config('email.defaults.port')
        );
	    $transport->setUsername(config('email.defaults.username'));
	    $transport->setPassword(config('email.defaults.password'));

	    $this->mailer = new Swift_Mailer($transport);
		$this->setupNewMessage();
	}

	protected function setupNewMessage()
    {
        $this->message = new Swift_Message();
        $this->setFromAddress(
            config('email.defaults.from_address'),
            config('email.defaults.from_name')
        );
    }

    public function emailFromConfig(string $key, array $params): EmailEngineContract
    {

        return $this;
    }

	public function send(): void
	{
		$this->mailer->send($this->message);
		$this->setupNewMessage();
	}

	public function setFromAddress(string $address,
		string $name = null): EmailEngineContract
	{
		if ($name) {
			$this->message->setFrom([$address => $name]);
		} else {
			$this->message->setFrom($address);
		}

		return $this;
	}

	public function addRecipient(string $address,
		string $name = null): EmailEngineContract
	{
		$this->message->addTo($address, $name);

		return $this;
	}

	public function addCc(string $address,
		string $name = null): EmailEngineContract
	{
		$this->message->addCc($address, $name);

		return $this;
	}

	public function addBcc(string $address,
		string $name = null): EmailEngineContract
	{
		$this->message->addBcc($address, $name);

		return $this;
	}

	public function addAttachment(string $path,
		string $name = null): EmailEngineContract
	{
		if ($name) {
			$this->message->attach(Swift_Attachment::fromPath($path)->setFilename($name));
		} else {
			$this->message->attach(Swift_Attachment::fromPath($path));
		}

		return $this;
	}

	public function setSubject(string $subject): EmailEngineContract
	{
		$this->message->setSubject($subject);

		return $this;
	}

	public function setBody(string $body): EmailEngineContract
	{
		$this->message->addPart($body, 'text/html');

		return $this;
	}

	public function setAltBody(string $altBody): EmailEngineContract
	{
		$this->message->setBody($altBody);

		return $this;
	}

	public function setCustomHeader(string $header,
		string $value): EmailEngineContract
	{
		$headers = $this->message->getHeaders();
		$headers->addTextHeader($header, $value);

		return $this;
	}
}