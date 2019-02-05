<?php

class HTMLPurifierTest extends \PHPUnit\Framework\TestCase
{
    private $instance = null;

    public function testCreateInstance()
    {
        $config = HTMLPurifier_Config::createDefault();
        $instance = new HTMLPurifier($config);
        $this->assertInstanceOf(HTMLPurifier::class, $instance);
    }

    public function testPurifier()
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.AllowedElements', [ 'b', 'i', 'li', 'u', 'ul', ]);
        $config->set('Core.EscapeInvalidTags', true);

        $instance = new HTMLPurifier($config);

        $safeHTML = $instance->purify('<b>Bold</b><i>Italic</i><ul><li>list</li></ul><u>underline</u><a href="hoo">aaa</a>');

        $this->assertSame(
            $safeHTML,
            '<b>Bold</b><i>Italic</i><ul><li>list</li></ul><u>underline</u>&lt;a href="hoo"&gt;aaa&lt;/a&gt;'
        );
    }
}
