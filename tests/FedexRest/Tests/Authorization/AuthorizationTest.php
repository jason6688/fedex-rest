<?php declare(strict_types=1);

namespace FedexRest\Tests\Authorization;

use FedexRest\Authorization\Authorize;
use FedexRest\Exceptions\MissingAuthCredentialsException;
use FedexRest\Tests\BaseTestCase;

class AuthorizationTest extends BaseTestCase
{

    public function testAuth()
    {
        $this->setupAuth();

        $this->assertObjectHasProperty('access_token', $this->auth->authorize());
    }

    public function testAuthRaw()
    {
        $this->setupAuth(true);

        $this->assertObjectHasProperty('headers', $this->auth->authorize());
    }

    public function testMissingCredentials()
    {
        try {
            (new Authorize)->authorize();
        } catch (MissingAuthCredentialsException $e) {
            $this->assertEquals('Please provide auth credentials', $e->getMessage());
        }
    }
}
