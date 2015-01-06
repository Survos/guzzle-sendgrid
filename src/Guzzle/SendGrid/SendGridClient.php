<?php

namespace Guzzle\SendGrid;

use Guzzle\Service\Client;
use Guzzle\Common\Collection;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Service\Description\XmlDescriptionBuilder;

class SendGridClient extends Client
{

    /**
     * @var string Username
     */
    protected $username;

    /**
     * @var string Password
     */
    protected $password;

    /**
     * Factory method to create a new SendGridClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *    username - API username
     *    password - API password
     *
     * @return SendGridClient
     *
     * @TODO update factory method and docblock for parameters
     */
    public static function factory($config = [])
    {
        $default = ['base_url' => 'https://sendgrid.com/api/'];
        $required = ['username', 'password', 'base_url'];
        $config = Collection::fromConfig($config, $default, $required);

        $client = new self($config->get('base_url'),
                           $config->get('username'),
                           $config->get('password'));
        $client->setConfig($config);

        // Uncomment the following two lines to use an XML service description
//        $client->setDescription(XmlDescriptionBuilder::build('file://'.__DIR__ . DIRECTORY_SEPARATOR . 'client.xml'));
        $client->setDescription(ServiceDescription::factory(__DIR__ . DIRECTORY_SEPARATOR . 'client.json'));

        return $client;
    }

    public function __construct($baseUrl, $username, $password)
    {
        parent::__construct($baseUrl);
        $this->username = $username;
        $this->password = $password;
    }

}