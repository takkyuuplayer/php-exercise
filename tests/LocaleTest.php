<?php

use PHPUnit\Framework\TestCase;

class LocaleTest extends TestCase
{
    public function testLocaleAcceptFromHttp()
    {
        $this->assertSame(
            'fr_CA',
            \Locale::acceptFromHttp('fr-CA,fr;q=0.9,en-AU;q=0.8,en-US;q=0.7,en;q=0.6,ja-JP;q=0.5,ja;q=0.4,en-CA;q=0.3')
        );

        $this->assertSame(
            'fr',
            \Locale::acceptFromHttp('fr;q=0.9,en-AU;q=0.8,en-US;q=0.7,en;q=0.6,ja-JP;q=0.5,ja;q=0.4,en-CA;q=0.3')
        );
    }
}
