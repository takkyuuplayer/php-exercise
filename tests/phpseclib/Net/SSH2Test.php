<?php

namespace Test\phpseclib\Net;

class SSH2Test extends \PHPUnit\Framework\TestCase
{
    public function testLogin()
    {
        $instance = new \phpseclib\Net\SSH2('sftp-server');

        $this->assertFalse($instance->login('foo', 'wrong-pass'));
        $this->assertTrue($instance->login('foo', 'pass'));
    }

    public function testSCP()
    {
        $ssh = new \phpseclib\Net\SSH2('sftp-server');
        $ssh->login('foo', 'pass');
        $scp = new \phpseclib\Net\SCP($ssh);

        $this->assertNotEmpty($scp);

        $scp = new \phpseclib\Net\SCP(null);

        $this->assertNotEmpty($scp);

        $ssh = new \phpseclib\Net\SSH2('sftp-server');
        $ssh->login('foo', 'wrong-pass');
        $scp = new \phpseclib\Net\SCP($ssh);

        $this->assertNotEmpty($scp);
    }
}
