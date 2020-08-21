<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-10
 * Time: 15:07
 */

namespace Helium\EmailNotifications\Contracts;

use Helium\EmailNotifications\Exceptions\MessageConfigException;
use Helium\ServiceManager\EngineContract;

abstract class EmailEngineContract implements EngineContract
{
    protected function getMessageConfig(string $key): array
    {
        $config = config("email.messages.{$key}");

        if (!$config)
        {
            throw new MessageConfigException("Missing configuration for message $key (email.messages.$key)");
        }

        $missingKeys = array_diff([
            'subject',
            'html_view',
            'plaintext_view'
        ], array_keys($config));

        if (!empty($missingKeys))
        {
            throw new MessageConfigException("Missing the following configuration keys for message $key: " . implode(', ', $missingKeys));
        }

        return $config;
    }

    public function emailFromConfig(string $key,
        array $params): EmailEngineContract
    {
        $config = $this->getMessageConfig($key);
        $viewTemplateDir = config('email.defaults.view_template_dir');

        $htmlContent = view($viewTemplateDir . '/' . $config['html_view'], $params);
        $plaintextContent = view($viewTemplateDir . '/' . $config['plaintext_view'], $params);

        $this->setSubject($config['subject']);
        $this->setBody($htmlContent);
        $this->setAltBody($plaintextContent);

        return $this;
    }

	abstract public function send(): void;

	abstract public function setFromAddress(string $address,
		string $name = null): EmailEngineContract;

	abstract public function addRecipient(string $address,
		string $name = null): EmailEngineContract;

	abstract public function addBcc(string $address,
		string $name = null): EmailEngineContract;

	abstract public function addCc(string $address,
		string $name = null): EmailEngineContract;

	abstract public function addAttachment(string $path,
		string $name = null): EmailEngineContract;

	abstract public function setSubject(string $subject): EmailEngineContract;

	abstract public function setBody(string $body): EmailEngineContract;

	abstract public function setAltBody(string $altBody): EmailEngineContract;

	abstract public function setCustomHeader(string $header,
		string $value): EmailEngineContract;
}