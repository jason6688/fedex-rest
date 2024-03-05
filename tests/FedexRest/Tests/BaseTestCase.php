<?php

namespace FedexRest\Tests;

use Dotenv\Dotenv;
use FedexRest\Authorization\Authorize;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected Authorize $auth;

    protected function setUp(): void
    {
        parent::setUp();
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
        $dotenv->safeLoad();
    }

    protected function setupAuth(bool $raw = false): void
    {
        if($raw) {
            $this->auth = (new Authorize)
                ->asRaw()
                ->setClientId($_ENV['CLIENT_ID'] ?? '')
                ->setClientSecret($_ENV['CLIENT_SECRET'] ?? '');
        } else {
            $this->auth = (new Authorize)
                ->setClientId($_ENV['CLIENT_ID'] ?? '')
                ->setClientSecret($_ENV['CLIENT_SECRET'] ?? '');
        }
    }
}